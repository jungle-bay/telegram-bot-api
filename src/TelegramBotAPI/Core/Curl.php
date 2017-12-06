<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * Class Curl
 * @package TelegramBotAPI\Core
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Curl {

    /**
     * @var resource $ch
     */
    private $ch;


    private function close() {

        if (false === is_resource($this->ch)) {
            return;
        }

        curl_close($this->ch);
    }

    /**
     * @return string
     * @throws TelegramBotAPIRuntimeException
     */
    private function execAndClose() {

        $response = curl_exec($this->ch);
        $codeError = curl_errno($this->ch);

        if ($codeError !== 0) {

            $messageError = empty($message = curl_error($this->ch)) ? 'Fatal error' : $message;

            throw new TelegramBotAPIRuntimeException($messageError, $messageError);
        }

        $this->close();

        return $response;
    }


    /**
     * @param array $parameters
     * @return string
     * @throws TelegramBotAPIRuntimeException
     */
    public function post($parameters = array()) {

        curl_setopt_array($this->ch, array(
            CURLOPT_SAFE_UPLOAD    => true,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_POSTFIELDS     => $parameters
        ));

        $response = $this->execAndClose();

        return $response;
    }

    /**
     * Curl constructor.
     * @param string $url
     */
    public function __construct($url) {
        $this->ch = curl_init($url);
    }
}
