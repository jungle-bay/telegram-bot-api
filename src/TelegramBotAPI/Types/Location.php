<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#location
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Location implements JsonDeserializer {

    /**
     * @var float $longitude
     */
    private $longitude;

    /**
     * @var float $latitude
     */
    private $latitude;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setLongitude($data['longitude']);
        $this->setLatitude($data['latitude']);
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
}
