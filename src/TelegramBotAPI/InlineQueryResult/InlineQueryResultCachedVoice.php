<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\TitleTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedvoice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedVoice extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string
     */
    private $type = 'voice';

    /**
     * @var string $voiceFileId
     */
    private $voiceFileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getVoiceFileId() {
        return $this->voiceFileId;
    }

    /**
     * @param string $voiceFileId
     */
    public function setVoiceFileId($voiceFileId) {
        $this->voiceFileId = $voiceFileId;
    }
}
