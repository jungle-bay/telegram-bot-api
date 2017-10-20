<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedaudio
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedAudio extends InlineQueryResult {

    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $audioFileId
     */
    private $audioFileId;


    /**
     * @return string
     */
    public function getType() {
        return 'audio';
    }

    /**
     * @return string
     */
    public function getAudioFileId() {
        return $this->audioFileId;
    }

    /**
     * @param string $audioFileId
     */
    public function setAudioFileId($audioFileId) {
        $this->audioFileId = $audioFileId;
    }
}
