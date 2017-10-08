<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#chatphoto
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChatPhoto implements JsonDeserializerInterface {

    /**
     * @var string $smallFileId
     */
    private $smallFileId;

    /**
     * @var string $bigFileId
     */
    private $bigFileId;


    /**
     * @api
     * @return string
     */
    public function getSmallFileId() {
        return $this->smallFileId;
    }

    /**
     * @api
     * @param string $smallFileId
     */
    public function setSmallFileId($smallFileId) {
        $this->smallFileId = $smallFileId;
    }

    /**
     * @api
     * @return string
     */
    public function getBigFileId() {
        return $this->bigFileId;
    }

    /**
     * @api
     * @param string $bigFileId
     */
    public function setBigFileId($bigFileId) {
        $this->bigFileId = $bigFileId;
    }

    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setSmallFileId($data['small_file_id']);
        $this->setBigFileId($data['big_file_id']);
    }
}
