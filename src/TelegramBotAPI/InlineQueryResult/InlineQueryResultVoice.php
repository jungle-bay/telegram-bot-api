<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvoice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVoice extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use InputMessageContentTrait;

    /**
     * @var string $voiceUrl
     */
    private $voiceUrl;

    /**
     * @var int|null $voiceDuration
     */
    private $voiceDuration;


    /**
     * @return string
     */
    public function getType() {
        return 'voice';
    }

    /**
     * @return string
     */
    public function getVoiceUrl() {
        return $this->voiceUrl;
    }

    /**
     * @param string $voiceUrl
     */
    public function setVoiceUrl($voiceUrl) {
        $this->voiceUrl = $voiceUrl;
    }

    /**
     * @return int|null
     */
    public function getVoiceDuration() {
        return $this->voiceDuration;
    }

    /**
     * @param int $voiceDuration
     */
    public function setVoiceDuration($voiceDuration) {
        $this->voiceDuration = $voiceDuration;
    }
}
