<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI\Core
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InitializationObject {

    /**
     * @param string $type
     * @return bool
     */
    protected function checkForRequired($type) {

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
    protected function checkForArray($type) {

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
    protected function isObj($type) {

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
     * Thank you: (https://github.com/symfony/property-access/blob/master/PropertyAccessor.php#L733)
     *
     * @param string $value
     * @return string
     */
    protected function camelize($value) {

        $value = str_replace('_', ' ', $value);
        $value = ucwords($value);

        return str_replace(' ', '', $value);
    }

    /**
     * @param $value
     * @return string
     */
    protected function unCamelize($value) {

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
    protected function setValue($key, $value) {

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
     * @param $value
     * @param $data
     * @return mixed
     */
    protected function getTypeObj($value, $data) {

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
    protected function initObj($key, array $data, array $check) {
        $obj = $this->getTypeObj($check['value'], $data[$key]);
        $this->setValue($key, $obj);
    }

    /**
     * @param string $key
     * @param array $data
     * @param array $check
     */
    protected function initArray($key, array $data, array $check) {

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
    protected function initArrayOfArray($key, array $data, array $check) {

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
    protected function initStart($key, array $data, array $check) {

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
}
