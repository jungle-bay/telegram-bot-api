<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Entities\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardButton extends Type {

    /**
     * @var string $text
     */
    private $text;

    /**
     * @var null|string $url
     */
    private $url;

    /**
     * @var null|string $callbackData
     */
    private $callbackData;

    /**
     * @var null|string $switchInlineQuery
     */
    private $switchInlineQuery;

    /**
     * @var null|string $switchInlineQueryCurrentChat
     */
    private $switchInlineQueryCurrentChat;

    /**
     * @var null|CallbackGame $callbackGame
     */
    private $callbackGame;

    /**
     * @var null|bool $pay
     */
    private $pay;



    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return null|string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return null|string
     */
    public function getCallbackData() {
        return $this->callbackData;
    }

    /**
     * @param null|string $callbackData
     */
    public function setCallbackData($callbackData) {
        $this->callbackData = $callbackData;
    }

    /**
     * @return null|string
     */
    public function getSwitchInlineQuery() {
        return $this->switchInlineQuery;
    }

    /**
     * @param null|string $switchInlineQuery
     */
    public function setSwitchInlineQuery($switchInlineQuery) {
        $this->switchInlineQuery = $switchInlineQuery;
    }

    /**
     * @return null|string
     */
    public function getSwitchInlineQueryCurrentChat() {
        return $this->switchInlineQueryCurrentChat;
    }

    /**
     * @param null|string $switchInlineQueryCurrentChat
     */
    public function setSwitchInlineQueryCurrentChat($switchInlineQueryCurrentChat) {
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
    }

    /**
     * @return null|CallbackGame
     */
    public function getCallbackGame() {
        return $this->callbackGame;
    }

    /**
     * @param null|CallbackGame $callbackGame
     */
    public function setCallbackGame($callbackGame) {
        $this->callbackGame = $callbackGame;
    }

    /**
     * @return bool|null
     */
    public function getPay() {
        return $this->pay;
    }

    /**
     * @param bool|null $pay
     */
    public function setPay($pay) {
        $this->pay = $pay;
    }
}
