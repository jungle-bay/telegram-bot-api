<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#audio
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Audio implements JsonDeserializer {

    /**
     * @var string $fileId
     */
    private $fileId;

    /**
     * @var int $duration
     */
    private $duration;

    /**
     * @var null|string $performer
     */
    private $performer;

    /**
     * @var null|string $title
     */
    private $title;

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
     * @return int
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @api
     * @param int $duration
     */
    public function setDuration($duration) {
        $this->duration = $duration;
    }

    /**
     * @api
     * @return null|string
     */
    public function getPerformer() {
        return $this->performer;
    }

    /**
     * @api
     * @param null|string $performer
     */
    public function setPerformer($performer) {
        $this->performer = $performer;
    }

    /**
     * @api
     * @return null|string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @api
     * @param null|string $title
     */
    public function setTitle($title) {
        $this->title = $title;
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

    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setFileId($data['file_id']);
        $this->setDuration($data['duration']);

        if (isset($data['performer'])) {
            $this->setPerformer($data['performer']);
        }

        if (isset($data['title'])) {
            $this->setTitle($data['title']);
        }

        if (isset($data['mime_type'])) {
            $this->setMimeType($data['mime_type']);
        }

        if (isset($data['file_size'])) {
            $this->setFileSize($data['file_size']);
        }
    }
}
