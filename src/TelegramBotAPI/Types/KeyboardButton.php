<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#keyboardbutton
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class KeyboardButton extends Type {

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
}
