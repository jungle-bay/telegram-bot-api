<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\PrivateConst as TBAConst;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultaudio
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultAudio extends InlineQueryResult {

    /**
     * @var string $audioUrl
     */
    private $audioUrl;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var null|string $caption
     */
    private $caption;

    /**
     * @var null|string $performer
     */
    private $performer;

    /**
     * @var null|int $audioDuration
     */
    private $audioDuration;

    /**
     * @var null|InputMessageContent $inputMessageContent
     */
    private $inputMessageContent;


    /**
     * @return string
     */
    public function getType() {
        return 'audio';
    }

    /**
     * @return string
     */
    public function getAudioUrl() {
        return $this->audioUrl;
    }

    /**
     * @param string $audioUrl
     */
    public function setAudioUrl($audioUrl) {
        $this->audioUrl = $audioUrl;
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

        if (empty($caption) || (strlen($caption) > TBAConst::CAPTION_SIZE_MAX)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
    }

    /**
     * @return null|string
     */
    public function getPerformer() {
        return $this->performer;
    }

    /**
     * @param null|string $performer
     */
    public function setPerformer($performer) {
        $this->performer = $performer;
    }

    /**
     * @return int|null
     */
    public function getAudioDuration() {
        return $this->audioDuration;
    }

    /**
     * @param int|null $audioDuration
     */
    public function setAudioDuration($audioDuration) {
        $this->audioDuration = $audioDuration;
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
