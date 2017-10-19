<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\Message;

trait UpdatingMessagesTrait {

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagetext
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageText(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'text'                     => PrivateConst::CHECK_REQUIRED,
            'chat_id'                  => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'               => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'parse_mode'               => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_PARSE_MODE_TYPE
            ),
            'disable_web_page_preview' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'             => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_TEXT);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagecaption
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageCaption(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
            'caption'           => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'reply_markup'      => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_CAPTION);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageReplyMarkup(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'      => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_REPLY_MARKUP);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deleteMessage
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteMessage(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'    => PrivateConst::CHECK_REQUIRED,
            'message_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::DELETE_MESSAGE);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }
}
