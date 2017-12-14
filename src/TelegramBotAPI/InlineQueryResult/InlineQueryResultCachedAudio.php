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


use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * Class InlineQueryResultCachedAudio
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedaudio
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedAudio extends InlineQueryResult {

    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'audio';

    /**
     * @var string $audioFileId
     */
    private $audioFileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
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
