<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#voice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Voice extends Type {

    /**
     * @var int $fileId
     */
    private $fileId;

    /**
     * @var int $duration
     */
    private $duration;

    /**
     * @var null|string $mimeType
     */
    private $mimeType;

    /**
     * @var null|int $fileSize
     */
    private $fileSize;


    /**
     * @return int
     */
    public function getFileId() {
        return $this->fileId;
    }

    /**
     * @param int $fileId
     */
    public function setFileId($fileId) {
        $this->fileId = $fileId;
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
