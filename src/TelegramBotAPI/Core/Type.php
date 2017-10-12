<?php

namespace TelegramBotAPI\Core;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializerInterface;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI\Core
 * @link https://core.telegram.org/bots/api#making-requests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class Type implements JsonSerializable, JsonDeserializerInterface {

    /**
     * Thank you: (https://github.com/symfony/property-access/blob/master/PropertyAccessor.php#L733)
     *
     * @param string $value
     * @return string
     */
    private function camelize($value) {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $value)));
    }

    private function unCamelize($value) {

        $value = preg_replace('/[A-Z]/', ' ${0}', $value);
        $value = str_replace(' ', '_', $value);

        return strtolower($value);
    }

    private function copyValue($key, $value) {

        $method = 'set' . $this->camelize($key);

        if (!method_exists($this, $method)) {
            throw new TelegramBotAPIRuntimeException('Fatal error method:' . $method . ' absent');
        }

        $this->{$method}($value);
    }


    /**
     * @param array $schema
     * @param array $data
     *
     * @throws TelegramBotAPIRuntimeException
     */
    protected function deserializer(array $schema, array $data) {

        foreach ($schema as $key => $value) {

            if (is_array($value)) {

                if (isset($value['array'])) {

                    if ($value['array'] === true) {

                        if (!isset($data[$key])) {
                            throw new TelegramBotAPIRuntimeException('error empty require field');
                        }

                        if (isset($value['require'])) {

                            foreach ($data[$key] as $datum) {

                                $obj = $value['value'];

                                if ($value['require'] === true) {

                                    if (!isset($data[$key])) {
                                        throw new TelegramBotAPIRuntimeException('error empty require field');
                                    }

                                    $this->copyValue($key, new $obj($data[$key]));

                                } else {

                                    if (!isset($data[$key])) {
                                        $this->copyValue($key, new $obj($data[$key]));
                                    }
                                }
                            }
                        }
                    }

                } elseif (isset($value['value'])) {

                    if (isset($value['require'])) {

                        $obj = $value['value'];

                        if ($value['require'] === true) {

                            if (!isset($data[$key])) {
                                throw new TelegramBotAPIRuntimeException('error empty require field');
                            }

                            $this->copyValue($key, new $obj($data[$key]));

                        } else {

                            if (!isset($data[$key])) {
                                $this->copyValue($key, new $obj($data[$key]));
                            }
                        }
                    }
                }

            } elseif ($value === true) {

                if (!isset($data[$key])) {
                    throw new TelegramBotAPIRuntimeException('error empty require field');
                }

                $this->copyValue($key, $value);

            } elseif ($value === false) {

                if (!isset($data[$key])) {
                    $this->copyValue($key, $value);
                }
            }
        }
    }


    /**
     * @return array
     */
    abstract protected function getSchemaValid();


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
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
        $this->deserializer($this->getSchemaValid(), $data);
    }
}
