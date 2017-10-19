<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedSticker extends InlineQueryResult {

    use InputMessageContentTrait;


    /**
     * @var string $stickerFileId
     */
    private $stickerFileId;


    /**
     * @return string
     */
    public function getType() {
        return 'sticker';
    }

    /**
     * @return string
     */
    public function getStickerFileId() {
        return $this->stickerFileId;
    }

    /**
     * @param string $stickerFileId
     */
    public function setStickerFileId($stickerFileId) {
        $this->stickerFileId = $stickerFileId;
    }
}
