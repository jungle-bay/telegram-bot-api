<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultMpeg4Gif extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use ThumbUrlTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'mpeg4_gif';

    /**
     * @var string $mpeg4Url
     */
    private $mpeg4Url;

    /**
     * @var null|int $mpeg4Width
     */
    private $mpeg4Width;

    /**
     * @var null|int $mpeg4Height
     */
    private $mpeg4Height;

    /**
     * @var null|int $mpeg4Duration
     */
    private $mpeg4Duration;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMpeg4Url() {
        return $this->mpeg4Url;
    }

    /**
     * @param string $mpeg4Url
     */
    public function setMpeg4Url($mpeg4Url) {
        $this->mpeg4Url = $mpeg4Url;
    }

    /**
     * @return int|null
     */
    public function getMpeg4Width() {
        return $this->mpeg4Width;
    }

    /**
     * @param int|null $mpeg4Width
     */
    public function setMpeg4Width($mpeg4Width) {
        $this->mpeg4Width = $mpeg4Width;
    }

    /**
     * @return int|null
     */
    public function getMpeg4Height() {
        return $this->mpeg4Height;
    }

    /**
     * @param int|null $mpeg4Height
     */
    public function setMpeg4Height($mpeg4Height) {
        $this->mpeg4Height = $mpeg4Height;
    }

    /**
     * @return int|null
     */
    public function getMpeg4Duration() {
        return $this->mpeg4Duration;
    }

    /**
     * @param int|null $mpeg4Duration
     */
    public function setMpeg4Duration($mpeg4Duration) {
        $this->mpeg4Duration = $mpeg4Duration;
    }
}
