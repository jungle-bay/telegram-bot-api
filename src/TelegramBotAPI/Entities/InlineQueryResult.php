<?php

namespace TelegramBotAPI\Entities;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Entities
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InlineQueryResult extends Type {

    /**
     * @return string
     */
    abstract public function getType();
}
