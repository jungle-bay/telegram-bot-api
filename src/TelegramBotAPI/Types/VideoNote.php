<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#videonote
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class VideoNote extends Type {

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
