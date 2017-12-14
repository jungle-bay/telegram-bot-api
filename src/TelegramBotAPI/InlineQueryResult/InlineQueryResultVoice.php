<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * Class InlineQueryResultVoice
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultvoice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultVoice extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'voice';

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
        return $this->type;
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
