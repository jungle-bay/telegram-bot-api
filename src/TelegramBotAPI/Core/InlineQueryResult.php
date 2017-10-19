<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Types\InlineKeyboardMarkup;

/**
 * @package TelegramBotAPI\Entities
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InlineQueryResult extends Type {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var null|InlineKeyboardMarkup $replyMarkup
     */
    private $replyMarkup;


    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return null|InlineKeyboardMarkup
     */
    public function getReplyMarkup() {
        return $this->replyMarkup;
    }

    /**
     * @param InlineKeyboardMarkup $replyMarkup
     */
    public function setReplyMarkup(InlineKeyboardMarkup $replyMarkup) {
        $this->replyMarkup = $replyMarkup;
    }


    /**
     * @return string
     */
    abstract public function getType();
}
