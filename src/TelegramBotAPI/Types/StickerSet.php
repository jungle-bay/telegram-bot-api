<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
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
     * @var bool $isMasks
     */
    private $isMasks;

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
    public function getMasks() {
        return $this->isMasks;
    }

    /**
     * @param bool $isMasks
     */
    public function setMasks($isMasks) {
        $this->isMasks = $isMasks;
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
