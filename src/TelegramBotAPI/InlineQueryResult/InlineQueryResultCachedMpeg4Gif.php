<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\TitleTrait;

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
     * @var string
     */
    private $type = 'mpeg4_gif';

    /**
     * @var string $mpeg4FileId
     */
    private $mpeg4FileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
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
