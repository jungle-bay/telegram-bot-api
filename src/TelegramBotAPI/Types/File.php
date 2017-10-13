<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#file
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class File extends Type {

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
