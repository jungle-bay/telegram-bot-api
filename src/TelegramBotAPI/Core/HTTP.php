<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI\Core
 * @link https://core.telegram.org/bots/api#making-requests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class HTTP extends Checks {

    const INTERNAL_SERVER_ERROR = 500;


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

        if (!preg_match(PrivateConst::CHECK_TOKEN_PATTERN, $token)) {
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



    /**
     * @param $ch
     * @return string
     *
     * @throws TelegramBotAPIRuntimeException
     */
    private function exec($ch) {

        $response = curl_exec($ch);
        $codeError = curl_errno($ch);

        curl_close($ch);

        if ($codeError !== 0) {

            $messageError = curl_error($ch);

            throw new TelegramBotAPIRuntimeException($messageError, $codeError);
        }

        return $response;
    }


    /**
     * @api
     * @param $url
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    protected function get($url, $parameters = array()) {

        if (empty($url)) {
            throw new TelegramBotAPIException('URL empty', self::INTERNAL_SERVER_ERROR);
        }

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $parameters
        ));

        $response = $this->exec($ch);

        return $response;
    }

    /**
     * @api
     * @param $url
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    protected function post($url, $parameters = array()) {

        if (empty($url)) {
            throw new TelegramBotAPIException('URL empty', self::INTERNAL_SERVER_ERROR);
        }

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_SAFE_UPLOAD    => true,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $parameters
        ));

        $response = $this->exec($ch);

        return $response;
    }



    protected function send($method, $url, $payload) {

        if ($method === PrivateConst::POST) {
            $response = $this->post($url, $payload);
        } else {
            $response = $this->get($url, $payload);
        }

        $data = $this->checkForBadRequest($response);

        return $data;
    }

    /**
     * @param string $method
     * @return string
     */
    protected function generateUrl($method) {

        $url = sprintf(PrivateConst::TELEGRAM_BOT_API, $this->getToken(), $method);

        return $url;
    }


    /**
     * @param null|string $token
     * @throws TelegramBotAPIException
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
     */
    public function __construct($token = null) {

        if (isset($token)) {
            $this->setToken($token);
        }
    }
}
