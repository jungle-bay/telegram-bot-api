<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\Type;
use TelegramBotAPI\Traits\IdTrait;
use TelegramBotAPI\Traits\ReplyMarkupTrait;

/**
 * @package TelegramBotAPI\Supports
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
