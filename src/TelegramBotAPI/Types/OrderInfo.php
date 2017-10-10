<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#orderinfo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class OrderInfo implements JsonDeserializerInterface {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['phone_number'])) {
            $this->setPhoneNumber($data['phone_number']);
        }

        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }

        if (isset($data['shipping_address'])) {
            $this->setShippingAddress(new ShippingAddress($data['shipping_address']));
        }
    }

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
