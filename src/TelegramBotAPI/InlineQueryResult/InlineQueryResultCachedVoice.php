<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Exception\TelegramBotAPIException;

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
     * @var string $voiceFileId
     */
    private $voiceFileId;


    /**
     * @return string
     */
    public function getType() {
        return 'voice';
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
