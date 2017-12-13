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
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#sticker
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Sticker extends Type {

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
     * @var string|null $setName
     */
    private $setName;

    /**
     * @var null|MaskPosition $maskPosition
     */
    private $maskPosition;

    /**
     * @var null|int $fileSize
     */
    private $fileSize;


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
     * @return string|null
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
     * @return null|MaskPosition
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
