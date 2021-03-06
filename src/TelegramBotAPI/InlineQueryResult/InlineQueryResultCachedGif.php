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
 * Class InlineQueryResultCachedGif
 * @package TelegramBotAPI\InlineQueryResult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedgif
 */
class InlineQueryResultCachedGif extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'gif';

    /**
     * @var string $gifFileId
     */
    private $gifFileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getGifFileId() {
        return $this->gifFileId;
    }

    /**
     * @param string $gifFileId
     */
    public function setGifFileId($gifFileId) {
        $this->gifFileId = $gifFileId;
    }
}
