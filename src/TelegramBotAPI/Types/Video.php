<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#video
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Video implements JsonDeserializerInterface {

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
     * @var int $duration
     */
    private $duration;

    /**
     * @var null|PhotoSize $thumb
     */
    private $thumb;

    /**
     * @var null|string $mimeType
     */
    private $mimeType;

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
        $this->setDuration($data['duration']);

        if (isset($data['thumb'])) $this->setThumb(new PhotoSize($data['thumb']));
        if (isset($data['mime_type'])) $this->setMimeType($data['mime_type']);
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
     * @return int
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration) {
        $this->duration = $duration;
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
    public function getMimeType() {
        return $this->mimeType;
    }

    /**
     * @param null|string $mimeType
     */
    public function setMimeType($mimeType) {
        $this->mimeType = $mimeType;
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
