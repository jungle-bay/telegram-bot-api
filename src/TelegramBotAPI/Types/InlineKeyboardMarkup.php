<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardMarkup extends Keyboard {

    /**
     * @var array InlineKeyboardButton[]
     */
    private $inlineKeyboard;


    /**
     * @return array InlineKeyboardButton[]
     */
    public function getInlineKeyboard() {
        return $this->inlineKeyboard;
    }

    /**
     * @param array InlineKeyboardButton[] $inlineKeyboard
     */
    public function setInlineKeyboard($inlineKeyboard) {
        $this->inlineKeyboard = $inlineKeyboard;
    }
}
