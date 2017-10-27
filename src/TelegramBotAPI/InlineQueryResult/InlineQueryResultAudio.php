<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultaudio
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultAudio extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string
     */
    private $type = 'audio';

    /**
     * @var string $audioUrl
     */
    private $audioUrl;

    /**
     * @var null|string $performer
     */
    private $performer;

    /**
     * @var null|int $audioDuration
     */
    private $audioDuration;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
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
}
