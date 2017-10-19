<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\DescriptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

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
     * @var string $photoFileId
     */
    private $photoFileId;


    /**
     * @return string
     */
    public function getType() {
        return 'photo';
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
