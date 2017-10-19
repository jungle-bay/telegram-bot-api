<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#document
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Document extends Type {

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
     * @api
     * @return string
     */
    public function getFileId() {
        return $this->fileId;
    }

    /**
     * @api
     * @param string $fileId
     */
    public function setFileId($fileId) {
        $this->fileId = $fileId;
    }

    /**
     * @api
     * @return null|PhotoSize
     */
    public function getThumb() {
        return $this->thumb;
    }

    /**
     * @api
     * @param null|PhotoSize $thumb
     */
    public function setThumb($thumb) {
        $this->thumb = $thumb;
    }

    /**
     * @api
     * @return null|string
     */
    public function getFileName() {
        return $this->fileName;
    }

    /**
     * @api
     * @param null|string $fileName
     */
    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    /**
     * @api
     * @return null|string
     */
    public function getMimeType() {
        return $this->mimeType;
    }

    /**
     * @api
     * @param null|string $mimeType
     */
    public function setMimeType($mimeType) {
        $this->mimeType = $mimeType;
    }

    /**
     * @api
     * @return int|null
     */
    public function getFileSize() {
        return $this->fileSize;
    }

    /**
     * @api
     * @param int|null $fileSize
     */
    public function setFileSize($fileSize) {
        $this->fileSize = $fileSize;
    }
}
