<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#audio
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Audio extends Type {

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
     * @return array
     */
    protected function getSchemaValid() {
        return array(
            'file_id'   => true,
            'duration'  => true,
            'performer' => false,
            'title'     => false,
            'mime_type' => false,
            'file_size' => false,
        );
    }
}
