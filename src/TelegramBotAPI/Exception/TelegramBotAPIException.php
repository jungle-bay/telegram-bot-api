<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Exception;


use Exception;
use TelegramBotAPI\Types\Update;

/**
 * Class TelegramBotAPIException
 * @package TelegramBotAPI\Exception
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPIException extends Exception {

    /**
     * @var Update $update
     */
    private $update;


    /**
     * @return Update
     */
    public function getUpdate() {
        return $this->update;
    }

    /**
     * @param Update $update
     */
    public function setUpdate($update) {
        $this->update = $update;
    }
}
