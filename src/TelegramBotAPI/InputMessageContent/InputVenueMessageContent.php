<?php

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\LatitudeTrait;
use TelegramBotAPI\Traits\LongitudeTrait;

/**
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputVenueMessageContent extends InputMessageContent {

    use LatitudeTrait;
    use LongitudeTrait;
    use TitleTrait;


    /**
     * @var string $address
     */
    private $address;

    /**
     * @var null|string $foursquareId
     */
    private $foursquareId;


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
}
