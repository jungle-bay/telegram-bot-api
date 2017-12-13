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
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultgif
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultGif extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use ThumbUrlTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'gif';

    /**
     * @var string $gifUrl
     */
    private $gifUrl;

    /**
     * @var null|int $gifWidth
     */
    private $gifWidth;

    /**
     * @var null|int $gifHeight
     */
    private $gifHeight;

    /**
     * @var null|int $gifDuration
     */
    private $gifDuration;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getGifUrl() {
        return $this->gifUrl;
    }

    /**
     * @param string $gifUrl
     */
    public function setGifUrl($gifUrl) {
        $this->gifUrl = $gifUrl;
    }

    /**
     * @return int|null
     */
    public function getGifWidth() {
        return $this->gifWidth;
    }

    /**
     * @param int|null $gifWidth
     */
    public function setGifWidth($gifWidth) {
        $this->gifWidth = $gifWidth;
    }

    /**
     * @return int|null
     */
    public function getGifHeight() {
        return $this->gifHeight;
    }

    /**
     * @param int|null $gifHeight
     */
    public function setGifHeight($gifHeight) {
        $this->gifHeight = $gifHeight;
    }

    /**
     * @return int|null
     */
    public function getGifDuration() {
        return $this->gifDuration;
    }

    /**
     * @param int|null $gifDuration
     */
    public function setGifDuration($gifDuration) {
        $this->gifDuration = $gifDuration;
    }
}
