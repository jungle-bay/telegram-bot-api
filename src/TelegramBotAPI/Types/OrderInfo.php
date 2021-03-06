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
 * Class OrderInfo
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#orderinfo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class OrderInfo extends Type {

    /**
     * @var null|string $name
     */
    private $name;

    /**
     * @var null|string $phoneNumber
     */
    private $phoneNumber;

    /**
     * @var null|string $email
     */
    private $email;

    /**
     * @var null|ShippingAddress $shippingAddress
     */
    private $shippingAddress;


    /**
     * @return null|string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * @param null|string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return null|string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return null|ShippingAddress
     */
    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    /**
     * @param null|ShippingAddress $shippingAddress
     */
    public function setShippingAddress($shippingAddress) {
        $this->shippingAddress = $shippingAddress;
    }
}
