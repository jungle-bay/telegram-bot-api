<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\PrivateConst as TBAConst;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedmpeg4gif
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedMpeg4Gif extends InlineQueryResult {

    /**
     * @var string $mpeg4FileId
     */
    private $mpeg4FileId;

    /**
     * @var null|string $title
     */
    private $title;

    /**
     * @var null|string $caption
     */
    private $caption;

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
        return 'mpeg4_gif';
    }

    /**
     * @return string
     */
    public function getMpeg4FileId() {
        return $this->mpeg4FileId;
    }

    /**
     * @param string $mpeg4FileId
     */
    public function setMpeg4FileId($mpeg4FileId) {
        $this->mpeg4FileId = $mpeg4FileId;
    }

    /**
     * @return null|string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     * @param null|string $caption
     * @throws TelegramBotAPIException
     */
    public function setCaption($caption) {

        if (empty($caption) || (strlen($caption) > TBAConst::CAPTION_MAX_SIZE)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
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
