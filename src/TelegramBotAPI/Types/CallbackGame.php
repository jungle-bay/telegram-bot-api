<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#callbackgame
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class CallbackGame extends Type {

    /**
     * @return array
     */
    protected function getSchemaValid() {
        return array();
    }
}
