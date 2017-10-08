<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardButton implements JsonSerializable, JsonDeserializer {

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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {

        $data = array();

        $data['text'] = $this->getText();

        if (!empty($this->pay)) $data['pay'] = $this->getPay();
        if (isset($this->url)) $data['url'] = $this->getUrl();
        if (isset($this->callbackData)) $data['callback_data'] = $this->getCallbackData();
        if (isset($this->switchInlineQuery)) $data['switch_inline_query'] = $this->getSwitchInlineQuery();
        if (isset($this->switchInlineQueryCurrentChat)) $data['switch_inline_query_current_chat'] = $this->getSwitchInlineQueryCurrentChat();
        if (isset($this->callbackGame)) $data['callback_game'] = $this->getCallbackGame();

        return $data;
    }

    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $this->setText($data['text']);

        if (isset($data['url'])) $this->setUrl($data['url']);
        if (isset($data['callback_data'])) $this->setCallbackData($data['callback_data']);
        if (isset($data['switch_inline_query'])) $this->setSwitchInlineQuery($data['switch_inline_query']);
        if (isset($data['switch_inline_query_current_chat'])) {
            $this->setSwitchInlineQueryCurrentChat($data['switch_inline_query_current_chat']);
        }
        if (isset($data['callback_game'])) $this->setCallbackGame(new CallbackGame($data['callback_game']));
        if (!empty($data['pay'])) $this->setPay($data['pay']);
    }
}
