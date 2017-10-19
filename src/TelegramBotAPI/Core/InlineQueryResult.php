<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\InlineQueryResult\Traits\IdTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ReplyMarkupTrait;

/**
 * @package TelegramBotAPI\Entities
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InlineQueryResult extends Type {

    use IdTrait;
    use ReplyMarkupTrait;


    /**
     * @return string
     */
    abstract public function getType();
}
