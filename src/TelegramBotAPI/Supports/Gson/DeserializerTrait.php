<?php

namespace TelegramBotAPI\Supports\Gson;


use ReflectionClass;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI\Supports\Gson
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait DeserializerTrait {

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
     * @param string $value
     * @return string
     */
    private function camelize($value) {

        $value = str_replace('_', ' ', $value);
        $value = ucwords($value);

        return str_replace(' ', '', $value);
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
     * @param mixed $value
     * @param mixed $data
     * @return mixed
     */
    private function getTypeObj($value, $data) {

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
    private function initArrayOfArray($key, array $data, array $check) {

        $type = $check['value'];
        $arr = array();

        foreach ($data[$key] as $value) {

            $values = array();

            foreach ($value as $check) {
                $values[] = $this->getTypeObj($type, $check);
            }

            $arr[] = $values;
        }

        $this->setValue($key, $arr);
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
            $arr[] = $this->getTypeObj($type, $value);
        }

        $this->setValue($key, $arr);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     */
    private function initObj($key, array $data, array $check) {
        $obj = $this->getTypeObj($check['value'], $data[$key]);
        $this->setValue($key, $obj);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     */
    private function initStart($key, array $data, array $check) {

        if (!isset($data[$key])) {
            return;
        }

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

            if (!preg_match('/@var\s+([^\s]+)/', $refProperty->getDocComment(), $matches)) {
                continue;
            }

            list(, $type) = $matches;

            $isRequired = $this->checkForRequired($type);

            if ($isRequired === false) {

                $type = str_replace('|null', '', $type);
                $type = str_replace('null|', '', $type);
            }

            $isArray = $this->checkForArray($type);

            if ($isArray === true) {

                $type = substr($type, 0, -2);
            }

            $isArrayArray = $this->checkForArray($type);

            if ($isArrayArray === true) {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) {
            return;
        }

        $schema = $this->getSchemaObject();
        $this->jsonDeserializer($schema, $data);
    }
}
