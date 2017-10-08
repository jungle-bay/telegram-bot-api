<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#update
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Update implements JsonDeserializerInterface {

    /**
     * @var int $updateId
     */
    private $updateId;

    /**
     * @var null|Message $message
     */
    private $message;

    /**
     * @var null|Message $editedMessage
     */
    private $editedMessage;

    /**
     * @var null|Message $channelPost
     */
    private $channelPost;

    /**
     * @var null|Message $editedChannelPost
     */
    private $editedChannelPost;

    /**
     * @var null|InlineQuery $inlineQuery
     */
    private $inlineQuery;

    /**
     * @var null|ChosenInlineResult $chosenInlineResult
     */
    private $chosenInlineResult;

    /**
     * @var null|CallbackQuery $callbackQuery
     */
    private $callbackQuery;

    /**
     * @var null|ShippingQuery $shippingQuery
     */
    private $shippingQuery;

    /**
     * @var null|PreCheckoutQuery $preCheckoutQuery
     */
    private $preCheckoutQuery;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setUpdateId($data['update_id']);

        if (isset($data['message'])) $this->setMessage(new Message($data['message']));
        if (isset($data['edited_message'])) $this->setEditedMessage(new Message($data['edited_message']));
        if (isset($data['channel_post'])) $this->setChannelPost(new Message($data['channel_post']));
        if (isset($data['edited_channel_post'])) $this->setEditedChannelPost(new Message($data['edited_channel_post']));
        if (isset($data['inline_query'])) $this->setInlineQuery(new InlineQuery($data['inline_query']));
        if (isset($data['chosen_inline_result'])) $this->setChosenInlineResult(new ChosenInlineResult($data['chosen_inline_result']));
        if (isset($data['callback_query'])) $this->setCallbackQuery(new CallbackQuery($data['callback_query']));
        if (isset($data['shipping_query'])) $this->setShippingQuery(new ShippingQuery($data['shipping_query']));
        if (isset($data['pre_checkout_query'])) $this->setPreCheckoutQuery(new PreCheckoutQuery($data['pre_checkout_query']));
    }

    /**
     * @return int
     */
    public function getUpdateId() {
        return $this->updateId;
    }

    /**
     * @param int $updateId
     */
    public function setUpdateId($updateId) {
        $this->updateId = $updateId;
    }

    /**
     * @return null|Message
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param null|Message $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * @return null|Message
     */
    public function getEditedMessage() {
        return $this->editedMessage;
    }

    /**
     * @param null|Message $editedMessage
     */
    public function setEditedMessage($editedMessage) {
        $this->editedMessage = $editedMessage;
    }

    /**
     * @return null|Message
     */
    public function getChannelPost() {
        return $this->channelPost;
    }

    /**
     * @param null|Message $channelPost
     */
    public function setChannelPost($channelPost) {
        $this->channelPost = $channelPost;
    }

    /**
     * @return null|Message
     */
    public function getEditedChannelPost() {
        return $this->editedChannelPost;
    }

    /**
     * @param null|Message $editedChannelPost
     */
    public function setEditedChannelPost($editedChannelPost) {
        $this->editedChannelPost = $editedChannelPost;
    }

    /**
     * @return null|InlineQuery
     */
    public function getInlineQuery() {
        return $this->inlineQuery;
    }

    /**
     * @param null|InlineQuery $inlineQuery
     */
    public function setInlineQuery($inlineQuery) {
        $this->inlineQuery = $inlineQuery;
    }

    /**
     * @return null|ChosenInlineResult
     */
    public function getChosenInlineResult() {
        return $this->chosenInlineResult;
    }

    /**
     * @param null|ChosenInlineResult $chosenInlineResult
     */
    public function setChosenInlineResult($chosenInlineResult) {
        $this->chosenInlineResult = $chosenInlineResult;
    }

    /**
     * @return null|CallbackQuery
     */
    public function getCallbackQuery() {
        return $this->callbackQuery;
    }

    /**
     * @param null|CallbackQuery $callbackQuery
     */
    public function setCallbackQuery($callbackQuery) {
        $this->callbackQuery = $callbackQuery;
    }

    /**
     * @return null|ShippingQuery
     */
    public function getShippingQuery() {
        return $this->shippingQuery;
    }

    /**
     * @param null|ShippingQuery $shippingQuery
     */
    public function setShippingQuery($shippingQuery) {
        $this->shippingQuery = $shippingQuery;
    }

    /**
     * @return null|PreCheckoutQuery
     */
    public function getPreCheckoutQuery() {
        return $this->preCheckoutQuery;
    }

    /**
     * @param null|PreCheckoutQuery $preCheckoutQuery
     */
    public function setPreCheckoutQuery($preCheckoutQuery) {
        $this->preCheckoutQuery = $preCheckoutQuery;
    }
}
