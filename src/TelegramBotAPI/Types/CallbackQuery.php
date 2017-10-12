<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#callbackquery
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class CallbackQuery extends Type {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var User $from
     */
    private $from;

    /**
     * @var null|Message $message
     */
    private $message;

    /**
     * @var null|string $inlineMessageId
     */
    private $inlineMessageId;

    /**
     * @var string $chatInstance
     */
    private $chatInstance;

    /**
     * @var null|string $data
     */
    private $data;

    /**
     * @var null|string $gameShortName
     */
    private $gameShortName;


    /**
     * @api
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @api
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @api
     * @return User
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @api
     * @param User $from
     */
    public function setFrom($from) {
        $this->from = $from;
    }

    /**
     * @api
     * @return null|Message
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @api
     * @param null|Message $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * @api
     * @return null|string
     */
    public function getInlineMessageId() {
        return $this->inlineMessageId;
    }

    /**
     * @api
     * @param null|string $inlineMessageId
     */
    public function setInlineMessageId($inlineMessageId) {
        $this->inlineMessageId = $inlineMessageId;
    }

    /**
     * @api
     * @return string
     */
    public function getChatInstance() {
        return $this->chatInstance;
    }

    /**
     * @api
     * @param string $chatInstance
     */
    public function setChatInstance($chatInstance) {
        $this->chatInstance = $chatInstance;
    }

    /**
     * @api
     * @return null|string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @api
     * @param null|string $data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * @api
     * @return null|string
     */
    public function getGameShortName() {
        return $this->gameShortName;
    }

    /**
     * @api
     * @param null|string $gameShortName
     */
    public function setGameShortName($gameShortName) {
        $this->gameShortName = $gameShortName;
    }


    /**
     * @return array
     */
    protected function getSchemaValid() {
        return array(
            'id'                => true,
            'from'              => array(
                'value'   => User::class,
                'require' => true
            ),
            'message'           => array(
                'value'   => Message::class,
                'require' => false
            ),
            'inline_message_id' => false,
            'chat_instance'     => false,
            'data'              => false,
            'game_short_name'   => false,

        );
    }
}
