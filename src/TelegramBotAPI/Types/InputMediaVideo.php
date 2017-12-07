<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 07.12.17
 * Time: 14:08
 */

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Traits\CaptionTrait;

/**
 * Class InputMediaVideo
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inputmediavideo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputMediaVideo extends InputMedia {

    use CaptionTrait;


    /**
     * @var string $type
     */
    private $type = 'video';

    /**
     * @var int|null $width
     */
    private $width;

    /**
     * @var int|null $height
     */
    private $height;

    /**
     * @var int|null $duration
     */
    private $duration;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param int|null $width
     */
    public function setWidth($width) {
        $this->width = $width;
    }

    /**
     * @return int|null
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param int|null $height
     */
    public function setHeight($height) {
        $this->height = $height;
    }

    /**
     * @return int|null
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     */
    public function setDuration($duration) {
        $this->duration = $duration;
    }
}
