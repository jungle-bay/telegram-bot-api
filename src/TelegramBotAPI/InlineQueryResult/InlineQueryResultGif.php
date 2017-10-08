<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\PrivateConst as TBAConst;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultgif
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultGif extends InlineQueryResult {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $gifUrl
     */
    private $gifUrl;

    /**
     * @var null|int $gifWidth
     */
    private $gifWidth;

    /**
     * @var null|int $gifHeight
     */
    private $gifHeight;

    /**
     * @var null|int $gifDuration
     */
    private $gifDuration;

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
        return 'gif';
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getGifUrl() {
        return $this->gifUrl;
    }

    /**
     * @param string $gifUrl
     */
    public function setGifUrl($gifUrl) {
        $this->gifUrl = $gifUrl;
    }

    /**
     * @return int|null
     */
    public function getGifWidth() {
        return $this->gifWidth;
    }

    /**
     * @param int|null $gifWidth
     */
    public function setGifWidth($gifWidth) {
        $this->gifWidth = $gifWidth;
    }

    /**
     * @return int|null
     */
    public function getGifHeight() {
        return $this->gifHeight;
    }

    /**
     * @param int|null $gifHeight
     */
    public function setGifHeight($gifHeight) {
        $this->gifHeight = $gifHeight;
    }

    /**
     * @return int|null
     */
    public function getGifDuration() {
        return $this->gifDuration;
    }

    /**
     * @param int|null $gifDuration
     */
    public function setGifDuration($gifDuration) {
        $this->gifDuration = $gifDuration;
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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @throws TelegramBotAPIException
     * @since 5.4.0
     */
    public function jsonSerialize() {

        if (empty($this->id)) {
            throw new TelegramBotAPIException('id require');
        }

        if (empty($this->gifUrl)) {
            throw new TelegramBotAPIException('gif url require');
        }

        $data = array();

        $data['type'] = $this->getType();
        $data['id'] = $this->getId();
        $data['gif_url'] = $this->getGifUrl();

        if (isset($this->gifWidth)) {
            $data['gif_width'] = $this->getGifWidth();
        }

        if (isset($this->gifHeight)) {
            $data['gif_height'] = $this->getGifHeight();
        }

        if (isset($this->gifDuration)) {
            $data['gif_duration'] = $this->getGifDuration();
        }

        if (isset($this->thumbUrl)) {
            $data['thumb_url'] = $this->getThumbUrl();
        }

        if (isset($this->title)) {
            $data['title'] = $this->getTitle();
        }

        if (isset($this->caption)) {
            $data['caption'] = $this->getCaption();
        }

        if (isset($this->replyMarkup)) {
            $data['reply_markup'] = $this->getReplyMarkup()->arraySerialize();
        }

        if (isset($this->inputMessageContent)) {
            $data['input_message_content'] = $this->getInputMessageContent();
        }

        return $data;
    }
}
