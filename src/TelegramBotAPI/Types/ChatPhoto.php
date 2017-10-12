<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#chatphoto
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChatPhoto extends Type {

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
     * @return array
     */
    protected function getSchemaValid() {
        return array(
            'small_file_id' => true,
            'big_file_id'   => true,
        );
    }
}
