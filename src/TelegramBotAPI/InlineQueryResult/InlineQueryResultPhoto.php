<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultPhoto extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use ThumbUrlTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'photo';

    /**
     * @var string $photoUrl
     */
    private $photoUrl;

    /**
     * @var null|int $photoWidth
     */
    private $photoWidth;

    /**
     * @var null|int $photoHeight
     */
    private $photoHeight;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPhotoUrl() {
        return $this->photoUrl;
    }

    /**
     * @param string $photoUrl
     */
    public function setPhotoUrl($photoUrl) {
        $this->photoUrl = $photoUrl;
    }

    /**
     * @return int|null
     */
    public function getPhotoWidth() {
        return $this->photoWidth;
    }

    /**
     * @param int|null $photoWidth
     */
    public function setPhotoWidth($photoWidth) {
        $this->photoWidth = $photoWidth;
    }

    /**
     * @return int|null
     */
    public function getPhotoHeight() {
        return $this->photoHeight;
    }

    /**
     * @param int|null $photoHeight
     */
    public function setPhotoHeight($photoHeight) {
        $this->photoHeight = $photoHeight;
    }
}
