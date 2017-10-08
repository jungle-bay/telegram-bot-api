<?php

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputcontactmessagecontent8
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputContactMessageContent extends InputMessageContent {

    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var null|string $lastName
     */
    private $lastName;


    /**
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
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
     * @param string $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @throws TelegramBotAPIException
     * @since 5.4.0
     */
    public function jsonSerialize() {

        if (empty($this->phoneNumber)) {
            throw new TelegramBotAPIException('phone number require');
        }

        if (empty($this->firstName)) {
            throw new TelegramBotAPIException('first name require');
        }

        $data = array();

        $data['phone_number'] = $this->getPhoneNumber();
        $data['first_name'] = $this->getFirstName();

        if (isset($this->lastName)) {
            $data['last_name'] = $this->getLastName();
        }

        return $data;
    }
}
