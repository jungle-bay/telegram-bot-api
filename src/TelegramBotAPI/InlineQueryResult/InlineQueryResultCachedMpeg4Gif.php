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
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedmpeg4gif
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedMpeg4Gif extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $mpeg4FileId
     */
    private $mpeg4FileId;


    /**
     * @return string
     */
    public function getType() {
        return 'mpeg4_gif';
    }

    /**
     * @return string
     */
    public function getMpeg4FileId() {
        return $this->mpeg4FileId;
    }

    /**
     * @param string $mpeg4FileId
     */
    public function setMpeg4FileId($mpeg4FileId) {
        $this->mpeg4FileId = $mpeg4FileId;
    }
}
