<?php

namespace TelegramBotAPI\Exception;


use Exception;

/**
 * @package TelegramBotAPI\Exception
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPIException extends Exception {

    /**
     * @param string $message
     */
    public function throwWarning($message) {

        trigger_error($message, E_USER_WARNING);
    }
}
