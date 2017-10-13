<?php

namespace TelegramBotAPI\Core;


use ReflectionClass;
use JsonSerializable;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

abstract class Type implements JsonSerializable {

    private function camelize($value) {

        $value = str_replace('_', ' ', $value);
        $value = ucwords($value);

        return str_replace(' ', '', $value);
    }

    private function unCamelize($value) {

        $value = preg_replace('/[A-Z]/', ' ${0}', $value);
        $value = str_replace(' ', '_', $value);

        return strtolower($value);
    }

    private function copyValue($key, $value) {

        $name = $this->camelize($key);

        if (substr($name, 0, 2) === 'Is') {
            $name = str_replace('Is', '', $name);
        }

        $method = 'set' . $name;

        if (!method_exists($this, $method)) {
            throw new TelegramBotAPIRuntimeException('Fatal error method: ' . $method . ' absent');
        }

        $this->{$method}($value);
    }

    private function getSchemaObject($proxiesDir) {

        if ($proxiesDir === null) {

            $schema = $this->createSchema();
        } else {

            $fileName = 'schema_' . $this->unCamelize(get_class($this));
            $pathSchema = $proxiesDir . DIRECTORY_SEPARATOR . $fileName;

            if (file_exists($pathSchema)) {

                $schema = unserialize(file_get_contents($pathSchema));
            } else {

                $schema = $this->createSchema();

                file_put_contents($pathSchema, serialize($schema));
            }
        }

        return $schema;
    }

    private function createSchema() {

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

                    $type = str_replace('[]', '', $type);
                }

                $schema[$this->unCamelize($refProperty->name)] = array(
                    'value'   => $type,
                    'require' => $isRequired,
                    'array'   => $isArray
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

    private function iniObj($value, $data, $proxiesDir) {

        if ($this->isObj($value)) {

            $class = get_class($this);
            $ns = substr($class, 0, strrpos($class, '\\'));
            $value = $ns . '\\' . $value;

            return new $value($data, $proxiesDir);
        } else {

            return $data;
        }
    }

    private function deserializer(array $schema, array $data, $proxiesDir) {

        foreach ($schema as $key => $value) {

            if ($value['require'] === true) {

                if (!isset($data[$key])) {
                    throw new TelegramBotAPIRuntimeException('error empty require field');
                }
            }

            if (isset($data[$key])) {

                if ($value['array'] === true) {

                    $type = $value['value'];
                    $objs = array();

                    foreach ($data[$key] as $item) {
                        $objs[] = $this->iniObj($type, $item, $proxiesDir);
                    }

                    $this->copyValue($key, $objs);

                    return;
                }

                $obj = $this->iniObj($value['value'], $data[$key], $proxiesDir);
                $this->copyValue($key, $obj);
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

    public function __construct(array $data = array(), $proxiesDir = null) {

        $schema = $this->getSchemaObject($proxiesDir);
        $this->deserializer($schema, $data, $proxiesDir);
    }
}
