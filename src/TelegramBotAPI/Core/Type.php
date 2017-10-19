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
    private function setValue($key, $value) {

        $name = $this->camelize($key);

        if (substr($name, 0, 2) === 'Is') {
            $name = substr($name, 2);
        }

        $method = 'set' . $name;

        if (!method_exists($this, $method)) {
            throw new TelegramBotAPIRuntimeException('Method: ' . $method . ' absent to ' . get_called_class());
        }

        $this->{$method}($value);
    }

    /**
     * @param string $type
     * @return bool
     */
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

    /**
     * @param $value
     * @param $data
     * @return mixed
     */
    private function getType($value, $data) {

        if (!$this->isObj($value)) {
            return $data;
        }

        $class = get_class($this);
        $ns = substr($class, 0, strrpos($class, '\\'));
        $class = $ns . '\\' . $value;

        return new $class($data);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     */
    private function initObj($key, array $data, array $check) {
        $obj = $this->getType($check['value'], $data[$key]);
        $this->setValue($key, $obj);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     */
    private function initArray($key, array $data, array $check) {

        $type = $check['value'];
        $arr = array();

        foreach ($data[$key] as $value) {
            $arr[] = $this->getType($type, $value);
        }

        $this->setValue($key, $arr);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     */
    private function initArrayOfArray($key, array $data, array $check) {

        $type = $check['value'];
        $arr = array();

        foreach ($data[$key] as $value) {

            $values = array();

            foreach ($value as $check) {
                $values[] = $this->getType($type, $check);
            }

            $arr[] = $values;
        }

        $this->setValue($key, $arr);
    }

    /**
     * @param array $schema
     * @param array $data
     *
     * @throws TelegramBotAPIRuntimeException
     */
    private function jsonDeserializer(array $schema, array $data) {

        foreach ($schema as $key => $check) {

            if ($check['require'] === true) {
                if (!isset($data[$key])) {
                    throw new TelegramBotAPIRuntimeException('Required ' . $key . ' empty to ' . get_called_class());
                }
            }

            if (isset($data[$key])) {

                if ($check['array_array'] === true) {
                    $this->initArrayOfArray($key, $data, $check);

                    continue;
                }

                if ($check['array'] === true) {
                    $this->initArray($key, $data, $check);

                    continue;
                }

                $this->initObj($key, $data, $check);
            }
        }
    }

    /**
     * @param string $type
     * @return bool
     */
    private function checkForArray($type) {

        $brackets = substr($type, -2);

        if ($brackets === '[]') {
            return true;
        }

        return false;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function checkForRequired($type) {

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

    /**
     * @return array
     */
    private function getSchemaObject() {

        $schema = array();
        $refClass = new ReflectionClass($this);

        foreach ($refClass->getProperties() as $refProperty) {

            if (!preg_match('/@var\s+([^\s]+)/', $refProperty->getDocComment(), $matches)) {
                continue;
            }

            list(, $type) = $matches;

            $isRequired = $this->checkForRequired($type);

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

        return $schema;
    }


    /**
     * {@inheritdoc}
     */
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

    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $schema = $this->getSchemaObject();
        $this->jsonDeserializer($schema, $data);
    }
}
