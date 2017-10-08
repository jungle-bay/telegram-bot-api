<?php

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputlocationmessagecontent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputLocationMessageContent extends InputMessageContent {

    /**
     * @var float $latitude
     */
    private $latitude;

    /**
     * @var float $longitude
     */
    private $longitude;


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

        $data = array();

        $data['latitude'] = $this->getLatitude();
        $data['longitude'] = $this->getLongitude();

        return $data;
    }
}
