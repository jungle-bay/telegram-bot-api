<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#callbackgame
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class CallbackGame implements JsonSerializable, JsonDeserializerInterface {

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return array();
    }

    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

    }
}
