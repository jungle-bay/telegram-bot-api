<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVenue extends InlineQueryResult {

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
     * @var null|InputMessageContent $inputMessageContent
     */
    private $inputMessageContent;

    /**
     * @var null|string $thumbUrl
     */
    private $thumbUrl;

    /**
     * @var null|int $thumbWidth
     */
    private $thumbWidth;

    /**
     * @var null|int $thumbHeight
     */
    private $thumbHeight;


    /**
     * @return string
     */
    public function getType() {
        return 'venue';
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
     * @param null|string $foursquareId
     */
    public function setFoursquareId($foursquareId) {
        $this->foursquareId = $foursquareId;
    }

    /**
     * @return null|InputMessageContent
     */
    public function getInputMessageContent() {
        return $this->inputMessageContent;
    }

    /**
     * @param null|InputMessageContent $inputMessageContent
     */
    public function setInputMessageContent(InputMessageContent $inputMessageContent) {
        $this->inputMessageContent = $inputMessageContent;
    }

    /**
     * @return null|string
     */
    public function getThumbUrl() {
        return $this->thumbUrl;
    }

    /**
     * @param null|string $thumbUrl
     */
    public function setThumbUrl($thumbUrl) {
        $this->thumbUrl = $thumbUrl;
    }

    /**
     * @return int|null
     */
    public function getThumbWidth() {
        return $this->thumbWidth;
    }

    /**
     * @param int|null $thumbWidth
     */
    public function setThumbWidth($thumbWidth) {
        $this->thumbWidth = $thumbWidth;
    }

    /**
     * @return int|null
     */
    public function getThumbHeight() {
        return $this->thumbHeight;
    }

    /**
     * @param int|null $thumbHeight
     */
    public function setThumbHeight($thumbHeight) {
        $this->thumbHeight = $thumbHeight;
    }
}
