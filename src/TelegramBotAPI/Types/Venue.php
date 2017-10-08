<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#venue
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Venue implements JsonDeserializerInterface {

    /**
     * @var Location $location
     */
    private $location;

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setLocation(new Location($data['location']));
        $this->setTitle($data['title']);
        $this->setAddress($data['address']);

        if (isset($data['foursquare_id'])) $this->setFoursquareId($data['foursquare_id']);
    }

    /**
     * @return Location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation($location) {
        $this->location = $location;
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
     * @param null|string $foursquareId
     */
    public function setFoursquareId($foursquareId) {
        $this->foursquareId = $foursquareId;
    }
}
