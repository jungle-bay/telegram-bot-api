<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#document
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Document implements JsonDeserializer {

    /**
     * @var string $fileId
     */
    private $fileId;

    /**
     * @var null|PhotoSize $thumb
     */
    private $thumb;

    /**
     * @var null|string $fileName
     */
    private $fileName;

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

        if (isset($data['thumb'])) $this->setThumb(new PhotoSize($data['thumb']));
        if (isset($data['file_name'])) $this->setFileName($data['file_name']);
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
    public function getFileName() {
        return $this->fileName;
    }

    /**
     * @param null|string $fileName
     */
    public function setFileName($fileName) {
        $this->fileName = $fileName;
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
