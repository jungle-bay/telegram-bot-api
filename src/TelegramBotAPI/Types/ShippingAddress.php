<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#shippingaddress
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingAddress implements JsonDeserializer {

    /**
     * @var string $countryCode
     */
    private $countryCode;

    /**
     * @var string $state
     */
    private $state;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $streetLine1
     */
    private $streetLine1;

    /**
     * @var string $streetLine2
     */
    private $streetLine2;

    /**
     * @var string $postCode
     */
    private $postCode;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setCountryCode($data['country_code']);
        $this->setState($data['state']);
        $this->setCity($data['city']);
        $this->setStreetLine1($data['street_line1']);
        $this->setStreetLine2($data['street_line2']);
        $this->setPostCode($data['post_code']);
    }

    /**
     * @return string
     */
    public function getCountryCode() {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode) {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state) {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStreetLine1() {
        return $this->streetLine1;
    }

    /**
     * @param string $streetLine1
     */
    public function setStreetLine1($streetLine1) {
        $this->streetLine1 = $streetLine1;
    }

    /**
     * @return string
     */
    public function getStreetLine2() {
        return $this->streetLine2;
    }

    /**
     * @param string $streetLine2
     */
    public function setStreetLine2($streetLine2) {
        $this->streetLine2 = $streetLine2;
    }

    /**
     * @return string
     */
    public function getPostCode() {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     */
    public function setPostCode($postCode) {
        $this->postCode = $postCode;
    }
}
