<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\PrivateConst as TBAConst;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultMpeg4Gif extends InlineQueryResult {

    /**
     * @var string $mpeg4Url
     */
    private $mpeg4Url;

    /**
     * @var null|int $mpeg4Width
     */
    private $mpeg4Width;

    /**
     * @var null|int $mpeg4Height
     */
    private $mpeg4Height;

    /**
     * @var null|int $mpeg4Duration
     */
    private $mpeg4Duration;

    /**
     * @var string $thumbUrl
     */
    private $thumbUrl;

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
    public function getMpeg4Url() {
        return $this->mpeg4Url;
    }

    /**
     * @param string $mpeg4Url
     */
    public function setMpeg4Url($mpeg4Url) {
        $this->mpeg4Url = $mpeg4Url;
    }

    /**
     * @return int|null
     */
    public function getMpeg4Width() {
        return $this->mpeg4Width;
    }

    /**
     * @param int|null $mpeg4Width
     */
    public function setMpeg4Width($mpeg4Width) {
        $this->mpeg4Width = $mpeg4Width;
    }

    /**
     * @return int|null
     */
    public function getMpeg4Height() {
        return $this->mpeg4Height;
    }

    /**
     * @param int|null $mpeg4Height
     */
    public function setMpeg4Height($mpeg4Height) {
        $this->mpeg4Height = $mpeg4Height;
    }

    /**
     * @return int|null
     */
    public function getMpeg4Duration() {
        return $this->mpeg4Duration;
    }

    /**
     * @param int|null $mpeg4Duration
     */
    public function setMpeg4Duration($mpeg4Duration) {
        $this->mpeg4Duration = $mpeg4Duration;
    }

    /**
     * @return string
     */
    public function getThumbUrl() {
        return $this->thumbUrl;
    }

    /**
     * @param string $thumbUrl
     */
    public function setThumbUrl($thumbUrl) {
        $this->thumbUrl = $thumbUrl;
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
