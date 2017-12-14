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


use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * Class InlineQueryResultCachedSticker
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedSticker extends InlineQueryResult {

    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'sticker';

    /**
     * @var string $stickerFileId
     */
    private $stickerFileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStickerFileId() {
        return $this->stickerFileId;
    }

    /**
     * @param string $stickerFileId
     */
    public function setStickerFileId($stickerFileId) {
        $this->stickerFileId = $stickerFileId;
    }
}
