<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Constants;
use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\DescriptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\MimeTypeTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbUrlTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVideo extends InlineQueryResult {

    use MimeTypeTrait;
    use TitleTrait;
    use CaptionTrait;
    use DescriptionTrait;
    use ThumbUrlTrait;
    use InputMessageContentTrait;


    /**
     * @var string $videoUrl
     */
    private $videoUrl;

    /**
     * @var null|int $videoWidth
     */
    private $videoWidth;

    /**
     * @var null|int $videoHeight
     */
    private $videoHeight;

    /**
     * @var null|string $videoDuration
     */
    private $videoDuration;


    /**
     * @return string
     */
    public function getType() {
        return 'video';
    }

    /**
     * @return string
     */
    public function getVideoUrl() {
        return $this->videoUrl;
    }

    /**
     * @param string $videoUrl
     */
    public function setVideoUrl($videoUrl) {
        $this->videoUrl = $videoUrl;
    }

    /**
     * @return int|null
     */
    public function getVideoWidth() {
        return $this->videoWidth;
    }

    /**
     * @param int|null $videoWidth
     */
    public function setVideoWidth($videoWidth) {
        $this->videoWidth = $videoWidth;
    }

    /**
     * @return int|null
     */
    public function getVideoHeight() {
        return $this->videoHeight;
    }

    /**
     * @param int|null $videoHeight
     */
    public function setVideoHeight($videoHeight) {
        $this->videoHeight = $videoHeight;
    }

    /**
     * @return null|string
     */
    public function getVideoDuration() {
        return $this->videoDuration;
    }

    /**
     * @param null|string $videoDuration
     */
    public function setVideoDuration($videoDuration) {
        $this->videoDuration = $videoDuration;
    }
}
