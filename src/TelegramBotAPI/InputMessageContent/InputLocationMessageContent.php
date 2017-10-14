<?php

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Core\InputMessageContent;

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
     * @var null|int $longitude
     */
    private $livePeriod;


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
     * @return null|int
     */
    public function getLivePeriod() {
        return $this->livePeriod;
    }

    /**
     * @param int $livePeriod
     */
    public function setLivePeriod($livePeriod) {
        $this->livePeriod = $livePeriod;
    }
}
