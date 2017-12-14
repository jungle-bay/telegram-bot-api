<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Core;


use ReflectionClass;
use JsonSerializable;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * Class GSON
 * @package TelegramBotAPI\Core
 * @link https://en.wikipedia.org/wiki/Gson
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class GSON implements JsonSerializable {

    /**
     * @param string $value
     * @return string
     */
    private function unCamelize($value) {

        $value = preg_replace('/[A-Z]/', ' ${0}', $value);
        $value = str_replace(' ', '_', $value);

        return strtolower($value);
    }

    /**
     * @param string $value
     * @return string
     */
    private function camelize($value) {

        $value = str_replace('_', ' ', $value);
        $value = ucwords($value);

        return str_replace(' ', '', $value);
    }


    /**
     * @param string $type
     * @return bool
     */
    private function checkForRequired($type) {

        $type = explode('|', $type);

        if (isset($type[0])) if ('null' === $type[0]) return false;

        if (isset($type[1])) if ('null' === $type[1]) return false;

        return true;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function checkForArray($type) {

        $brackets = substr($type, -2);

        return ('[]' === $brackets);
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
     * @param string $key
     * @param mixed $value
     * @throws TelegramBotAPIRuntimeException
     */
    private function setValue($key, $value) {

        $name = $this->camelize($key);

        if ('Is' === substr($name, 0, 2)) $name = substr($name, 2);

        $method = 'set' . $name;

        if (false === method_exists($this, $method)) {
            throw new TelegramBotAPIRuntimeException('Method: ' . $method . ' absent to ' . get_called_class());
        }

        $this->{$method}($value);
    }


    /**
     * @param mixed $value
     * @param mixed $data
     * @return mixed
     */
    private function getTypeObj($value, $data) {

        if (!$this->isObj($value)) return $data;

        $class = get_class($this);
        $ns = substr($class, 0, strrpos($class, '\\'));
        $class = $ns . '\\' . $value;

        return new $class($data);
    }


    /**
     * @param string $key
     * @param array $data
     * @param array $check
     * @throws TelegramBotAPIRuntimeException
     */
    private function initArrayOfArray($key, array $data, array $check) {

        $type = $check['value'];
        $arr = array();

        foreach ($data[$key] as $value) {

            $values = array();

            foreach ($value as $check) $values[] = $this->getTypeObj($type, $check);

            $arr[] = $values;
        }

        $this->setValue($key, $arr);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     * @throws TelegramBotAPIRuntimeException
     */
    private function initArray($key, array $data, array $check) {

        $type = $check['value'];
        $arr = array();

        foreach ($data[$key] as $value) $arr[] = $this->getTypeObj($type, $value);
        $this->setValue($key, $arr);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     * @throws TelegramBotAPIRuntimeException
     */
    private function initObj($key, array $data, array $check) {
        $obj = $this->getTypeObj($check['value'], $data[$key]);
        $this->setValue($key, $obj);
    }


    /**
     * @param string $key
     * @param array $data
     * @param array $check
     * @throws TelegramBotAPIRuntimeException
     */
    private function initStart($key, array $data, array $check) {

        if (!isset($data[$key])) return;

        if ($check['array_array'] === true) {
            $this->initArrayOfArray($key, $data, $check);

            return;
        }

        if ($check['array'] === true) {
            $this->initArray($key, $data, $check);

            return;
        }

        $this->initObj($key, $data, $check);
    }


    /**
     * @param array $schema
     * @param array $data
     * @throws TelegramBotAPIRuntimeException
     */
    private function jsonDeserializer(array $schema, array $data) {

        foreach ($schema as $key => $check) {

            if (true === $check['require']) {

                if (false === isset($data[$key])) {
                    throw new TelegramBotAPIRuntimeException('Required ' . $key . ' empty to ' . get_called_class());
                }
            }

            $this->initStart($key, $data, $check);
        }
    }

    /**
     * @return array
     */
    private function getSchemaObject() {

        $schema = array();
        $refClass = new ReflectionClass($this);

        foreach ($refClass->getProperties() as $refProperty) {

            if (false === preg_match('/@var\s+([^\s]+)/', $refProperty->getDocComment(), $matches)) continue;

            list(, $type) = $matches;

            $isRequired = $this->checkForRequired($type);

            if (false === $isRequired) {

                $type = str_replace('|null', '', $type);
                $type = str_replace('null|', '', $type);
            }

            $isArray = $this->checkForArray($type);

            if (true === $isArray) $type = substr($type, 0, -2);

            $isArrayArray = $this->checkForArray($type);

            if (true === $isArrayArray) $type = substr($type, 0, -2);

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
     * @param array $data
     * @throws TelegramBotAPIRuntimeException
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $schema = $this->getSchemaObject();
        $this->jsonDeserializer($schema, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() {

        $props = (array) $this;
        $json = array();

        foreach ($props as $key => $value) {

            if (null === $value) continue;

            if ('*' === substr($key, 1, 1)) $key = substr($key, 2);

            $key = str_replace(get_called_class(), '', $key);
            $key = str_replace(get_parent_class($this), '', $key);
            $key = str_replace("\0", '', $key);

            $json[$this->unCamelize($key)] = $value;
        }

        return $json;
    }
}
