<?php

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputVenueMessageContent extends InputMessageContent {

    /**
     * @var float $latitude
     */
    private $latitude;

    /**
     * @var float $longitude
     */
    private $longitude;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $address
     */
    private $address;

    /**
     * @var null|string $foursquareId
     */
    private $foursquareId;


    /**
     * @return float
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address) {
        $this->address = $address;
    }

    /**
     * @return null|string
     */
    public function getFoursquareId() {
        return $this->foursquareId;
    }

    /**
     * @param string $foursquareId
     */
    public function setFoursquareId($foursquareId) {
        $this->foursquareId = $foursquareId;
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

        if (empty($this->latitude)) {
            throw new TelegramBotAPIException('latitude require');
        }

        if (empty($this->longitude)) {
            throw new TelegramBotAPIException('longitude require');
        }

        if (empty($this->title)) {
            throw new TelegramBotAPIException('title require');
        }

        if (empty($this->address)) {
            throw new TelegramBotAPIException('address require');
        }

        $data = array();

        $data['latitude'] = $this->getLatitude();
        $data['longitude'] = $this->getLongitude();
        $data['title'] = $this->getTitle();
        $data['address'] = $this->getAddress();

        if (isset($this->foursquareId)) {
            $data['foursquare_id'] = $this->getFoursquareId();
        }

        return $data;
    }
}
