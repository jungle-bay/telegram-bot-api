<?php

namespace TelegramBotAPI\Core;


use ReflectionClass;
use JsonSerializable;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI\Core
 * @link https://core.telegram.org/bots/api#making-requests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class Type implements JsonSerializable {

    /**
     * Thank you: (https://github.com/symfony/property-access/blob/master/PropertyAccessor.php#L733)
     *
     * @param string $value
     * @return string
     */
    private function camelize($value) {

        $value = str_replace('_', ' ', $value);
        $value = ucwords($value);

        return str_replace(' ', '', $value);
    }

    /**
     * @param $value
     * @return string
     */
    private function unCamelize($value) {

        $value = preg_replace('/[A-Z]/', ' ${0}', $value);
        $value = str_replace(' ', '_', $value);

        return strtolower($value);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @throws TelegramBotAPIRuntimeException
     */
    private function copyValue($key, $value) {

        $name = $this->camelize($key);

        if (substr($name, 0, 2) === 'Is') {
            $name = str_replace('Is', '', $name);
        }

        $method = 'set' . $name;

        if (!method_exists($this, $method)) {
            throw new TelegramBotAPIRuntimeException('Fatal error method: ' . $method . ' absent.');
        }

        $this->{$method}($value);
    }

    private function getSchemaObject() {

        $schema = array();
        $refClass = new ReflectionClass($this);

        foreach ($refClass->getProperties() as $refProperty) {

            if (preg_match('/@var\s+([^\s]+)/', $refProperty->getDocComment(), $matches)) {

                list(, $type) = $matches;

                $isRequired = $this->checkForCompulsory($type);

                if (!$isRequired) {

                    $type = str_replace('|null', '', $type);
                    $type = str_replace('null|', '', $type);
                }

                $isArray = $this->checkForArray($type);

                if ($isArray) {

                    $type = substr($type, 0, -2);
                }

                $isArrayArray = $this->checkForArray($type);

                if ($isArrayArray) {

                    $type = substr($type, 0, -2);
                }

                $schema[$this->unCamelize($refProperty->name)] = array(
                    'value'       => $type,
                    'require'     => $isRequired,
                    'array'       => $isArray,
                    'array_array' => $isArrayArray
                );
            }
        }

        return $schema;
    }

    private function checkForCompulsory($type) {

        $type = explode('|', $type);

        if (isset($type[0])) {

            if ($type[0] === 'null') {

                return false;
            }
        }

        if (isset($type[1])) {

            if ($type[1] === 'null') {

                return false;
            }
        }

        return true;
    }

    private function checkForArray($type) {

        $brackets = substr($type, -2);

        if ($brackets === '[]') {
            return true;
        }

        return false;
    }

    private function isObj($type) {

        switch ($type) {

            case 'int':
            case 'float':
            case 'bool':
            case 'string':
                return false;
            default:
                return true;
        }
    }

    private function iniObj($value, $data) {

        if ($this->isObj($value)) {

            $class = get_class($this);
            $ns = substr($class, 0, strrpos($class, '\\'));
            $value = $ns . '\\' . $value;

            return new $value($data);
        } else {

            return $data;
        }
    }


    private function arrayArray($key, $data, $check) {

        $type = $check['value'];
        $arr = array();

        foreach ($data[$key] as $item) {

            $values = array();

            foreach ($item as $check) {
                $values[] = $this->iniObj($type, $check);
            }

            $arr[] = $values;
        }

        $this->copyValue($key, $arr);
    }

    private function arrA($key, $data, $check) {

        $type = $check['value'];
        $values = array();

        foreach ($data[$key] as $item) {
            $values[] = $this->iniObj($type, $item);
        }

        $this->copyValue($key, $values);
    }

    private function obj($key, $data, $check) {
        $obj = $this->iniObj($check['value'], $data[$key]);
        $this->copyValue($key, $obj);
    }

    private function deserializer(array $schema, array $data) {

        foreach ($schema as $key => $check) {

            if ($check['require'] === true) {
                if (empty($data[$key])) {
                    throw new TelegramBotAPIRuntimeException('Error empty require field.');
                }
            }

            if (isset($data[$key])) {

                if ($check['array_array'] === true) {
                    $this->arrayArray($key, $data, $check);

                    return;
                }

                if ($check['array'] === true) {
                    $this->arrA($key, $data, $check);

                    return;
                }

                $this->obj($key, $data, $check);
            }
        }
    }


    public function jsonSerialize() {

        $props = get_object_vars($this);
        $props = array_filter($props);
        $json = array();

        foreach ($props as $key => $value) {
            $json[$this->unCamelize($key)] = $value;
        }

        unset($props);

        return $json;
    }

    public function __construct(array $data = array()) {

        $schema = $this->getSchemaObject();
        $this->deserializer($schema, $data);
    }
}
