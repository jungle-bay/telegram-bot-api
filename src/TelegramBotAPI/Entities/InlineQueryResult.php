<?php

namespace TelegramBotAPI\Entities;


use JsonSerializable;

/**
 * @package TelegramBotAPI\Entities
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InlineQueryResult implements JsonSerializable {

    /**
     * @return string
     */
    abstract public function getType();
}
