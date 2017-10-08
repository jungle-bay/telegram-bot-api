<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#photosize
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class PhotoSize implements JsonDeserializer {

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
