<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\TitleTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedphoto
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedPhoto extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string
     */
    private $type = 'photo';

    /**
     * @var string $photoFileId
     */
    private $photoFileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPhotoFileId() {
        return $this->photoFileId;
    }

    /**
     * @param string $photoFileId
     */
    public function setPhotoFileId($photoFileId) {
        $this->photoFileId = $photoFileId;
    }
}
