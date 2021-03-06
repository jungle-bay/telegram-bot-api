<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Types;


/**
 * Class KeyboardButton
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
    public function isRequestContact() {
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
    public function isRequestLocation() {
        return $this->requestLocation;
    }

    /**
     * @param bool|null $requestLocation
     */
    public function setRequestLocation($requestLocation) {
        $this->requestLocation = $requestLocation;
    }
}
