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
abstract class Type extends InitializationObject implements JsonSerializable {

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
