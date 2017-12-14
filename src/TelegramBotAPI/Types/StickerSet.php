<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Types;


/**
 * Class StickerSet
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#stickerset
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class StickerSet extends Type {

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var bool $containsMasks
     */
    private $containsMasks;

    /**
     * @var Sticker[] $stickers
     */
    private $stickers;


    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isContainsMasks() {
        return $this->containsMasks;
    }

    /**
     * @param bool $containsMasks
     */
    public function setContainsMasks($containsMasks) {
        $this->containsMasks = $containsMasks;
    }

    /**
     * @return Sticker[]
     */
    public function getStickers() {
        return $this->stickers;
    }

    /**
     * @param Sticker[] $stickers
     */
    public function setStickers($stickers) {
        $this->stickers = $stickers;
    }
}
