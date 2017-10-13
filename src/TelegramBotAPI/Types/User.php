<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#user
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class User extends Type {

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var null|string $lastName
     */
    private $lastName;

    /**
     * @var null|string $username
     */
    private $username;

    /**
     * @var null|string $languageCode
     */
    private $languageCode;

    /**
     * @var null|bool $isBot
     */
    private $isBot;


    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param null|string $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * @return null|string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param null|string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return null|string
     */
    public function getLanguageCode() {
        return $this->languageCode;
    }

    /**
     * @param null|string $languageCode
     */
    public function setLanguageCode($languageCode) {
        $this->languageCode = $languageCode;
    }

    /**
     * @return null|bool
     */
    public function getBot() {
        return $this->isBot;
    }

    /**
     * @param null|bool $isBot
     */
    public function setBot($isBot) {
        $this->isBot = $isBot;
    }
}
