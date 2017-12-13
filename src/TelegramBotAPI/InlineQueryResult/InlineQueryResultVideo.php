<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\MimeTypeTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVideo extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use MimeTypeTrait;
    use ThumbUrlTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'video';

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
        return $this->type;
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
