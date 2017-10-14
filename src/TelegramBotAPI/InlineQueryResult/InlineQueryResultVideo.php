<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Constants as TBAConstPublic;
use TelegramBotAPI\PrivateConst as TBAConstPrivate;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVideo extends InlineQueryResult {

    /**
     * @var string $videoUrl
     */
    private $videoUrl;

    /**
     * @var string $mimeType
     */
    private $mimeType;

    /**
     * @var string $thumbUrl
     */
    private $thumbUrl;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var null|string $caption
     */
    private $caption;

    /**
     * @var null|int $videoWidth
     */
    private $videoWidth;

    /**
     * @var null|int $videoHeight
     */
    private $videoHeight;

    /**
     * @var null|string $videoDuration
     */
    private $videoDuration;

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
     * @return string
     */
    public function getType() {
        return 'video';
    }

    /**
     * @return string
     */
    public function getVideoUrl() {
        return $this->videoUrl;
    }

    /**
     * @param string $videoUrl
     */
    public function setVideoUrl($videoUrl) {
        $this->videoUrl = $videoUrl;
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

        if (($mimeType === TBAConstPublic::TEXT_HTML_MIME_TYPE) || ($mimeType === TBAConstPublic::VIDEO_MP4_MIME_TYPE)) {
            throw new TelegramBotAPIException('Mime type of the content of video url, “text/html” or “video/mp4”');
        }

        $this->mimeType = $mimeType;
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

        if (empty($caption) || (strlen($caption) > TBAConstPrivate::CAPTION_SIZE_MAX)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
    }

    /**
     * @return int|null
     */
    public function getVideoWidth() {
        return $this->videoWidth;
    }

    /**
     * @param int|null $videoWidth
     */
    public function setVideoWidth($videoWidth) {
        $this->videoWidth = $videoWidth;
    }

    /**
     * @return int|null
     */
    public function getVideoHeight() {
        return $this->videoHeight;
    }

    /**
     * @param int|null $videoHeight
     */
    public function setVideoHeight($videoHeight) {
        $this->videoHeight = $videoHeight;
    }

    /**
     * @return null|string
     */
    public function getVideoDuration() {
        return $this->videoDuration;
    }

    /**
     * @param null|string $videoDuration
     */
    public function setVideoDuration($videoDuration) {
        $this->videoDuration = $videoDuration;
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
}
