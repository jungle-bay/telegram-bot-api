<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#user
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class User implements JsonDeserializer {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setId($data['id']);
        $this->setFirstName($data['first_name']);

        if (isset($data['last_name'])) $this->setLastName($data['last_name']);
        if (isset($data['username'])) $this->setUsername($data['username']);
        if (isset($data['language_code'])) $this->setLanguageCode($data['language_code']);
    }

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
    public function getIsBot() {
        return $this->isBot;
    }

    /**
     * @param null|bool $isBot
     */
    public function setIsBot($isBot) {
        $this->isBot = $isBot;
    }
}
