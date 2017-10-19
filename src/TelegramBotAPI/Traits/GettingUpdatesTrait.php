<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\WebhookInfo;

trait GettingUpdatesTrait {

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setwebhook
     * @param string $response
     * @return Update[]
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setUpdates($response) {

        $data = (array) $this->checkForBadRequest($response);
        $result = array();

        foreach ($data as $obj) {
            $result[] = new Update($obj);
        }

        unset($data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getupdates
     * @param array $parameters
     * @return Update[]
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getUpdates($parameters = array()) {

        $payload = $this->checkParameter($parameters, array(
            'offset'          => PrivateConst::CHECK_NO_REQUIRED,
            'limit'           => PrivateConst::CHECK_NO_REQUIRED,
            'timeout'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_LIMIT
            ),
            'allowed_updates' => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::GET_UPDATES);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = array();

        foreach ($data as $obj) {
            $result[] = new Update($obj);
        }

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setwebhook
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setWebhook(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'url'             => PrivateConst::CHECK_REQUIRED,
            'certificate'     => PrivateConst::CHECK_NO_REQUIRED,
            'max_connections' => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_LIMIT
            ),
            'allowed_updates' => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_WEBHOOK);
        $result = $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletewebhook
     * @return bool
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteWebhook() {

        $url = $this->generateUrl(PrivateConst::DELETE_WEBHOOK);
        $result = $this->send(PrivateConst::GET, $url, array());

        unset($url);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     * @return WebhookInfo
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function getWebhookInfo() {

        $url = $this->generateUrl(PrivateConst::GET_WEBHOOK_INFO);
        $data = (array) $this->send(PrivateConst::GET, $url, array());

        $result = new WebhookInfo($data);

        unset($url, $data);

        return $result;
    }
}
