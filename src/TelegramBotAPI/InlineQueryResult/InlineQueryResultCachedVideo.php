<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\DescriptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\Core\InlineQueryResult;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedvideo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedVideo extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $videoFileId
     */
    private $videoFileId;


    /**
     * @return string
     */
    public function getType() {
        return 'video';
    }

    /**
     * @return string
     */
    public function getVideoFileId() {
        return $this->videoFileId;
    }

    /**
     * @param string $videoFileId
     */
    public function setVideoFileId($videoFileId) {
        $this->videoFileId = $videoFileId;
    }
}
