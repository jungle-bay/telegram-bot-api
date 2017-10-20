<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Supports\Validator;
use TelegramBotAPI\Exception\TelegramBotAPIException;

trait TokenTrait {

    /**
     * @var string $token
     */
    private $token;


    /**
     * @api
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
     * @param string $token
     *
     * @throws TelegramBotAPIException
     */
    public function setToken($token) {

        if (!preg_match(Validator::CHECK_TOKEN_PATTERN, $token)) {
            throw new TelegramBotAPIException('Telegram Bot API Token is not valid.');
        }

        $this->token = $token;
    }

    /**
     * @api
     * @return string
     *
     * @throws TelegramBotAPIException
     */
    public function getToken() {

        if (empty($this->token)) {
            throw new TelegramBotAPIException('`token` empty');
        }

        return $this->token;
    }
}
