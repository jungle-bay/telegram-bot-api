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
}
