<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\PrivateConst as TBAConst;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcacheddocument
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedDocument extends InlineQueryResult {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $documentFileId
     */
    private $documentFileId;

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
        return 'document';
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
     * @return string
     */
    public function getDocumentFileId() {
        return $this->documentFileId;
    }

    /**
     * @param string $documentFileId
     */
    public function setDocumentFileId($documentFileId) {
        $this->documentFileId = $documentFileId;
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

        if (empty($this->title)) {
            throw new TelegramBotAPIException('title require');
        }

        $data = array();

        $data['type'] = $this->getType();
        $data['id'] = $this->getId();
        $data['title'] = $this->getTitle();

        if (isset($this->documentFileId)) {
            $data['document_file_id'] = $this->getDocumentFileId();
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
