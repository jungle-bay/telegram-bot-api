<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Entities\InputMessageContent;
use TelegramBotAPI\Constants as TBAConstPublic;
use TelegramBotAPI\PrivateConst as TBAConstPrivate;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultDocument extends InlineQueryResult {

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $caption
     */
    private $caption;

    /**
     * @var string $documentUrl
     */
    private $documentUrl;

    /**
     * @var string $mimeType
     */
    private $mimeType;

    /**
     * @var null|string $description
     */
    private $description;

    /**
     * @var null|InlineKeyboardMarkup $replyMarkup
     */
    private $replyMarkup;

    /**
     * @var null|InputMessageContent $inputMessageContent
     */
    private $inputMessageContent;

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
        return 'document';
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
    public function getCaption() {
        return $this->caption;
    }

    /**
     * @param null|string $caption
     * @throws TelegramBotAPIException
     */
    public function setCaption($caption) {

        if (empty($caption) || (strlen($caption) > TBAConstPrivate::CAPTION_MAX_SIZE)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
    }

    /**
     * @return string
     */
    public function getDocumentUrl() {
        return $this->documentUrl;
    }

    /**
     * @param string $documentUrl
     */
    public function setDocumentUrl($documentUrl) {
        $this->documentUrl = $documentUrl;
    }

    /**
     * @return string
     */
    public function getMimeType() {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @throws TelegramBotAPIException
     */
    public function setMimeType($mimeType) {

        if (($mimeType !== TBAConstPublic::APPLICATION_PDF_MIME_TYPE) || ($mimeType !== TBAConstPublic::APPLICATION_ZIP_MIME_TYPE)) {
            throw new TelegramBotAPIException('Mime type of the content of the file, either “application/pdf” or “application/zip”');
        }

        $this->mimeType = $mimeType;
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
}
