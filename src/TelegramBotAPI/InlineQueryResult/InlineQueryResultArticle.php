<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultArticle extends InlineQueryResult {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var InputMessageContent $inputMessageContent
     */
    private $inputMessageContent;

    /**
     * @var null|InlineKeyboardMarkup $replyMarkup
     */
    private $replyMarkup;

    /**
     * @var null|string $url
     */
    private $url;

    /**
     * @var null|bool $hideUrl
     */
    private $hideUrl;

    /**
     * @var null|string $description
     */
    private $description;

    /**
     * @var null|string $thumbUrl
     */
    private $thumbUrl;

    /**
     * @var null|int $thumbWidth
     */
    private $thumbWidth;

    /**
     * @var null|int $thumbHeight
     */
    private $thumbHeight;


    /**
     * @return string
     */
    public function getType() {
        return 'article';
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
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return InputMessageContent
     */
    public function getInputMessageContent() {
        return $this->inputMessageContent;
    }

    /**
     * @param InputMessageContent $inputMessageContent
     */
    public function setInputMessageContent(InputMessageContent $inputMessageContent) {
        $this->inputMessageContent = $inputMessageContent;
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
     * @return null|string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return bool|null
     */
    public function getHideUrl() {
        return $this->hideUrl;
    }

    /**
     * @param bool|null $hideUrl
     */
    public function setHideUrl($hideUrl) {
        $this->hideUrl = $hideUrl;
    }

    /**
     * @return null|string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getThumbUrl() {
        return $this->thumbUrl;
    }

    /**
     * @param null|string $thumbUrl
     */
    public function setThumbUrl($thumbUrl) {
        $this->thumbUrl = $thumbUrl;
    }

    /**
     * @return int|null
     */
    public function getThumbWidth() {
        return $this->thumbWidth;
    }

    /**
     * @param int|null $thumbWidth
     */
    public function setThumbWidth($thumbWidth) {
        $this->thumbWidth = $thumbWidth;
    }

    /**
     * @return int|null
     */
    public function getThumbHeight() {
        return $this->thumbHeight;
    }

    /**
     * @param int|null $thumbHeight
     */
    public function setThumbHeight($thumbHeight) {
        $this->thumbHeight = $thumbHeight;
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

        if (empty($this->title)) {
            throw new TelegramBotAPIException('title require');
        }

        if (empty($this->inputMessageContent)) {
            throw new TelegramBotAPIException('input message content require');
        }

        $data = array();

        $data['type'] = $this->getType();
        $data['id'] = $this->getId();
        $data['title'] = $this->getTitle();
        $data['input_message_content'] = $this->getInputMessageContent();

        if (isset($this->replyMarkup)) {
            $data['reply_markup'] = $this->getReplyMarkup();
        }

        if (isset($this->url)) {
            $data['url'] = $this->getUrl();
        }

        if (isset($this->hideUrl)) {
            $data['hide_url'] = $this->getHideUrl();
        }

        if (isset($this->description)) {
            $data['description'] = $this->getDescription();
        }

        if (isset($this->thumbUrl)) {
            $data['thumb_url'] = $this->getThumbUrl();
        }

        if (isset($this->thumbWidth)) {
            $data['thumb_width'] = $this->getThumbWidth();
        }

        if (isset($this->thumbHeight)) {
            $data['thumb_height'] = $this->getThumbHeight();
        }

        return $data;
    }
}
