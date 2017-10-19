<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\Types\Message;

trait GamesTrait {

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendgame
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendGame(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'game_short_name'      => PrivateConst::CHECK_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_GAME);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setgamescore
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setGameScore(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'user_id'              => PrivateConst::CHECK_REQUIRED,
            'score'                => PrivateConst::CHECK_REQUIRED,
            'force'                => PrivateConst::CHECK_NO_REQUIRED,
            'disable_edit_message' => PrivateConst::CHECK_NO_REQUIRED,
            'chat_id'              => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id'    => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_GAME_SCORE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getgamehighscores
     * @param array $parameters
     * @return GameHighScore[]
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getGameHighScores(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'user_id'           => PrivateConst::CHECK_REQUIRED,
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::GET_GAME_HIGH_SCORES);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = array();

        foreach ($data as $obj) {
            $result[] = new GameHighScore($obj);
        }

        unset($parameters, $url, $payload, $data);

        return $result;
    }
}
