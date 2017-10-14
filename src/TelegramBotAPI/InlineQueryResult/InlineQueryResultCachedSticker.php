<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedSticker extends InlineQueryResult {

    /**
     * @var string $stickerFileId
     */
    private $stickerFileId;

    /**
     * @var null|InlineKeyboardMarkup $replyMarkup
     */
    private $replyMarkup;

    /**
     * @var null|InputMessageContent $inputMessageContent
     */
    private $inputMessageContent;


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

    /**
     * @return null|InlineKeyboardMarkup
     */
    public function getReplyMarkup() {
        return $this->replyMarkup;
    }

    /**
     * @param null|InlineKeyboardMarkup $replyMarkup
     */
    public function setReplyMarkup(InlineKeyboardMarkup $replyMarkup) {
        $this->replyMarkup = $replyMarkup;
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
}
