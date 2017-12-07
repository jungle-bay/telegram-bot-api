<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 07.12.17
 * Time: 14:02
 */

namespace TelegramBotAPI\Types;


/**
 * Class InputMedia
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inputmedia
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InputMedia extends Type {

    /**
     * @var string $media
     */
    private $media;


    /**
     * @return string
     */
    public function getMedia() {
        return $this->media;
    }

    /**
     * @param string $media
     */
    public function setMedia($media) {
        $this->media = $media;
    }
}
