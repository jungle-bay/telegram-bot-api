<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Entities\InlineQueryResult;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultGame extends InlineQueryResult {

    /**
     * @var string $type
     */
    private $id;

    /**
     * @var string $type
     */
    private $gameShortName;

    /**
     * @var null|InlineKeyboardMarkup $type
     */
    private $replyMarkup;


    /**
     * @return string
     */
    public function getType() {
        return 'game';
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getGameShortName() {
        return $this->gameShortName;
    }

    /**
     * @param string $gameShortName
     */
    public function setGameShortName($gameShortName) {
        $this->gameShortName = $gameShortName;
    }

    /**
     * @return null|InlineKeyboardMarkup
     */
    public function getReplyMarkup() {
        return $this->replyMarkup;
    }

    /**
     * @param null|InlineKeyboardMarkup $replyMarkup
     */
    public function setReplyMarkup(InlineKeyboardMarkup $replyMarkup) {
        $this->replyMarkup = $replyMarkup;
    }
}
