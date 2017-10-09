<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI\Core
 * @link https://core.telegram.org/bots/api#making-requests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class HTTP {

    const INTERNAL_SERVER_ERROR = 500;


    /**
     * @param $ch
     * @return false|string
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
     * @param string $response
     * @return array
     * @throws TelegramBotAPIRuntimeException
     */
    protected function checkForBadRequest($response) {

        $data = json_decode($response, true);

        if ($data === null) {
            throw new TelegramBotAPIRuntimeException('I can not spread the answer', self::INTERNAL_SERVER_ERROR);
        }

        if ($data['ok'] === false) {
            throw new TelegramBotAPIRuntimeException($data['description'], $data['error_code']);
        }

        return $data['result'];
    }


    /**
     * @api
     * @param $url
     * @param array $parameters
     * @return bool|array
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function get($url, $parameters = array()) {

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $parameters
        ));

        $response = $this->exec($ch);
        $result = $this->checkForBadRequest($response);

        return $result;
    }

    /**
     * @api
     * @param $url
     * @param array $parameters
     * @return bool|array
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function post($url, $parameters = array()) {

        if (empty($url)) {
            throw new TelegramBotAPIException('URL Empty', self::INTERNAL_SERVER_ERROR);
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
        $result = $this->checkForBadRequest($response);

        return $result;
    }
}
