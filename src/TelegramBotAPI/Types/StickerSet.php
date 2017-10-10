<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#stickerset
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class StickerSet implements JsonDeserializerInterface {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setName($data['name']);
        $this->setTitle($data['title']);
        $this->setMasks($data['is_masks']);

        $stickers = array();

        foreach ($data['stickers'] as $sticker) {
            $stickers[] = new Sticker($sticker);
        }

        $this->setStickers($stickers);
    }

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
