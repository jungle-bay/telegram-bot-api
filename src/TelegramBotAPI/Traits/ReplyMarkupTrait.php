<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Types\InlineKeyboardMarkup;

trait ReplyMarkupTrait {

    /**
     * @var null|InlineKeyboardMarkup $replyMarkup
     */
    private $replyMarkup;


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
}
