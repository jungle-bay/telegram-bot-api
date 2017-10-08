<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#keyboardbutton
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class KeyboardButton implements JsonSerializable, JsonDeserializer {

    /**
     * @var string $text
     */
    private $text;

    /**
     * @var null|bool $requestContact
     */
    private $requestContact;

    /**
     * @var null|bool $requestLocation
     */
    private $requestLocation;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $this->setText($data['text']);

        if (isset($data['request_contact'])) $this->setRequestContact($data['request_contact']);
        if (isset($data['request_location'])) $this->setRequestLocation($data['request_location']);
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return bool|null
     */
    public function getRequestContact() {
        return $this->requestContact;
    }

    /**
     * @param bool|null $requestContact
     */
    public function setRequestContact($requestContact) {
        $this->requestContact = $requestContact;
    }

    /**
     * @return bool|null
     */
    public function getRequestLocation() {
        return $this->requestLocation;
    }

    /**
     * @param bool|null $requestLocation
     */
    public function setRequestLocation($requestLocation) {
        $this->requestLocation = $requestLocation;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {

        $data = array();

        $data['text'] = $this->getText();

        if (isset($this->requestContact)) $data['request_contact'] = $this->getRequestContact();
        if (isset($this->requestLocation)) $data['request_location'] = $this->getRequestLocation();

        return $data;
    }
}
