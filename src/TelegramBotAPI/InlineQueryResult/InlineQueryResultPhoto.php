<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\PrivateConst as TBAConst;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultPhoto extends InlineQueryResult {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $photoUrl
     */
    private $photoUrl;

    /**
     * @var string $thumbUrl
     */
    private $thumbUrl;

    /**
     * @var null|int $photoWidth
     */
    private $photoWidth;

    /**
     * @var null|int $photoHeight
     */
    private $photoHeight;

    /**
     * @var null|string $title
     */
    private $title;

    /**
     * @var null|string $description
     */
    private $description;

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
        return 'photo';
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
    public function getPhotoUrl() {
        return $this->photoUrl;
    }

    /**
     * @param string $photoUrl
     */
    public function setPhotoUrl($photoUrl) {
        $this->photoUrl = $photoUrl;
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
     * @return int|null
     */
    public function getPhotoWidth() {
        return $this->photoWidth;
    }

    /**
     * @param int|null $photoWidth
     */
    public function setPhotoWidth($photoWidth) {
        $this->photoWidth = $photoWidth;
    }

    /**
     * @return int|null
     */
    public function getPhotoHeight() {
        return $this->photoHeight;
    }

    /**
     * @param int|null $photoHeight
     */
    public function setPhotoHeight($photoHeight) {
        $this->photoHeight = $photoHeight;
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

        if (empty($this->photoUrl)) {
            throw new TelegramBotAPIException('photo url require');
        }

        if (empty($this->thumbUrl)) {
            throw new TelegramBotAPIException('thumb url require');
        }

        $data = array();

        $data['type'] = $this->getType();
        $data['id'] = $this->getId();
        $data['photo_url'] = $this->getPhotoUrl();
        $data['thumb_url'] = $this->getThumbUrl();

        if (isset($this->title)) {
            $data['title'] = $this->getTitle();
        }

        if (isset($this->description)) {
            $data['description'] = $this->getDescription();
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
