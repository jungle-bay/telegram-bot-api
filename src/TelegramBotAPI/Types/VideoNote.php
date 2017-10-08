<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#videonote
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class VideoNote implements JsonDeserializerInterface {

    /**
     * @var string $fileId
     */
    private $fileId;

    /**
     * @var int $length
     */
    private $length;

    /**
     * @var int $duration
     */
    private $duration;

    /**
     * @var null|PhotoSize $thumb
     */
    private $thumb;

    /**
     * @var null|int $fileSize
     */
    private $fileSize;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setFileId($data['file_id']);
        $this->setLength($data['length']);
        $this->setDuration($data['duration']);

        if (isset($data['thumb'])) $this->setThumb(new PhotoSize($data['thumb']));
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
    public function getLength() {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength($length) {
        $this->length = $length;
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
