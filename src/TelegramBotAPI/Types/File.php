<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#file
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class File implements JsonDeserializer {

    /**
     * @var string $fileId
     */
    private $fileId;

    /**
     * @var null|int $fileSize
     */
    private $fileSize;

    /**
     * @var null|string $filePath
     */
    private $filePath;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setFileId($data['file_id']);

        if (isset($data['file_size'])) $this->setFileSize($data['file_size']);
        if (isset($data['file_path'])) $this->setFilePath($data['file_path']);
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

    /**
     * @return null|string
     */
    public function getFilePath() {
        return $this->filePath;
    }

    /**
     * @param null|string $filePath
     */
    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }
}
