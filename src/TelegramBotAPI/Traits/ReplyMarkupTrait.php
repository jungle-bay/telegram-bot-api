<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Types\InlineKeyboardMarkup;

trait ReplyMarkupTrait {

    /**
     * @var null|InlineKeyboardMarkup $replyMarkup
     */
    protected $replyMarkup;


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
