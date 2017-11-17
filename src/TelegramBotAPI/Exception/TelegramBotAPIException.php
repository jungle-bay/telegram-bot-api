<?php

namespace TelegramBotAPI\Exception;


use Exception;
use TelegramBotAPI\Types\Update;

/**
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

    /**
     * @param string $message
     */
    public function throwWarning($message) {

        trigger_error($message, E_USER_WARNING);
    }
}
