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
 * Class InlineKeyboardMarkup
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardMarkup extends Type {

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
