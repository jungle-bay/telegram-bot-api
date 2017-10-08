<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardMarkup implements JsonSerializable, JsonDeserializerInterface {

    /**
     * @var array InlineKeyboardButton[]
     */
    private $inlineKeyboard;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $keyboard = array();

        foreach ($data['inline_keyboard'] as $row) {

            $tmpRow = array();

            foreach ($row as $button) {
                $tmpRow[] = new InlineKeyboardButton($button);
            }

            $keyboard[] = $tmpRow;
        }

        $this->setInlineKeyboard($keyboard);
    }

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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {

        $data = array();

        foreach ($this->getInlineKeyboard() as $row) {

            $tmpRow = array();

            foreach ($row as $button) {

                /** @var InlineKeyboardButton $button */
                $tmpRow[] = $button;
            }

            $data['inline_keyboard'][] = $tmpRow;
        }

        return $data;
    }
}
