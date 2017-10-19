<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\InlineQueryResult\Traits\LatitudeTrait;
use TelegramBotAPI\InlineQueryResult\Traits\LongitudeTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbHeightTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbUrlTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthAndHeight;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVenue extends InlineQueryResult {

    use TitleTrait;
    use InputMessageContentTrait;
    use ThumbUrlTrait;
    use LongitudeTrait;
    use LatitudeTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;


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
    public function getType() {
        return 'venue';
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
