<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#sticker
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Sticker implements JsonDeserializer {

    /**
     * @var string $fileId
     */
    private $fileId;

    /**
     * @var int $width
     */
    private $width;

    /**
     * @var int $height
     */
    private $height;

    /**
     * @var null|PhotoSize $thumb
     */
    private $thumb;

    /**
     * @var null|string $emoji
     */
    private $emoji;

    /**
     * @var string $setName
     */
    private $setName;

    /**
     * @var MaskPosition $maskPosition
     */
    private $maskPosition;

    /**
     * @var null|int $fileSize
     */
    private $fileSize;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setFileId($data['file_id']);
        $this->setWidth($data['width']);
        $this->setHeight($data['height']);

        if (isset($data['thumb'])) $this->setThumb(new PhotoSize($data['thumb']));
        if (isset($data['emoji'])) $this->setEmoji($data['emoji']);
        if (isset($data['set_name'])) $this->setSetName($data['set_name']);
        if (isset($data['mask_position'])) $this->setMaskPosition(new MaskPosition($data['mask_position']));
        if (isset($data['file_size'])) $this->setFileSize($data['file_size']);
    }

    /**
     * @return string
     */
    public function getFileId() {
        return $this->fileId;
    }

    /**
     * @param string $fileId
     */
    public function setFileId($fileId) {
        $this->fileId = $fileId;
    }

    /**
     * @return int
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width) {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height) {
        $this->height = $height;
    }

    /**
     * @return null|PhotoSize
     */
    public function getThumb() {
        return $this->thumb;
    }

    /**
     * @param null|PhotoSize $thumb
     */
    public function setThumb($thumb) {
        $this->thumb = $thumb;
    }

    /**
     * @return null|string
     */
    public function getEmoji() {
        return $this->emoji;
    }

    /**
     * @param null|string $emoji
     */
    public function setEmoji($emoji) {
        $this->emoji = $emoji;
    }

    /**
     * @return string
     */
    public function getSetName() {
        return $this->setName;
    }

    /**
     * @param string $setName
     */
    public function setSetName($setName) {
        $this->setName = $setName;
    }

    /**
     * @return MaskPosition
     */
    public function getMaskPosition() {
        return $this->maskPosition;
    }

    /**
     * @param MaskPosition $maskPosition
     */
    public function setMaskPosition($maskPosition) {
        $this->maskPosition = $maskPosition;
    }

    /**
     * @return int|null
     */
    public function getFileSize() {
        return $this->fileSize;
    }

    /**
     * @param int|null $fileSize
     */
    public function setFileSize($fileSize) {
        $this->fileSize = $fileSize;
    }
}
