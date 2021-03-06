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
 * Class Contact
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#contact
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Contact extends Type {

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
     * @var null|int $userId
     */
    private $userId;


    /**
     * @api
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * @api
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @api
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @api
     * @param string $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @api
     * @return null|string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @api
     * @param null|string $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * @api
     * @return int|null
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @api
     * @param int|null $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }
}
