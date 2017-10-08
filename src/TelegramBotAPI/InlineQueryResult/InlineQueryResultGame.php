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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @throws TelegramBotAPIException
     * @since 5.4.0
     */
    public function jsonSerialize() {

        if (empty($this->id)) {
            throw new TelegramBotAPIException('id require');
        }

        if (empty($this->gameShortName)) {
            throw new TelegramBotAPIException('game short name require');
        }

        $data = array();

        $data['type'] = $this->getType();
        $data['id'] = $this->getId();
        $data['game_short_name'] = $this->getGameShortName();

        if (isset($this->replyMarkup)) {
            $data['reply_markup'] = $this->getReplyMarkup();
        }

        return $data;
    }
}
