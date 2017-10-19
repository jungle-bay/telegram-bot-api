<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\Message;

trait PaymentsTrait {

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendinvoice
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendInvoice(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'               => PrivateConst::CHECK_REQUIRED,
            'title'                 => PrivateConst::CHECK_REQUIRED,
            'description'           => PrivateConst::CHECK_REQUIRED,
            'payload'               => PrivateConst::CHECK_REQUIRED,
            'provider_token'        => PrivateConst::CHECK_REQUIRED,
            'start_parameter'       => PrivateConst::CHECK_REQUIRED,
            'currency'              => PrivateConst::CHECK_REQUIRED,
            'prices'                => PrivateConst::CHECK_REQUIRED,
            'photo_url'             => PrivateConst::CHECK_NO_REQUIRED,
            'photo_size'            => PrivateConst::CHECK_NO_REQUIRED,
            'photo_width'           => PrivateConst::CHECK_NO_REQUIRED,
            'photo_height'          => PrivateConst::CHECK_NO_REQUIRED,
            'need_name'             => PrivateConst::CHECK_NO_REQUIRED,
            'need_phone_number'     => PrivateConst::CHECK_NO_REQUIRED,
            'need_email'            => PrivateConst::CHECK_NO_REQUIRED,
            'need_shipping_address' => PrivateConst::CHECK_NO_REQUIRED,
            'is_flexible'           => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'   => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'          => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_INVOICE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answershippingquery
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerShippingQuery(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'shipping_query_id' => PrivateConst::CHECK_REQUIRED,
            'ok'                => PrivateConst::CHECK_REQUIRED,
            'shipping_options'  => PrivateConst::CHECK_NO_REQUIRED,
            'error_message'     => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::ANSWER_SHIPPING_QUERY);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerPreCheckoutQuery(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'pre_checkout_query_id' => PrivateConst::CHECK_REQUIRED,
            'ok'                    => PrivateConst::CHECK_REQUIRED,
            'error_message'         => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::ANSWER_SHIPPING_QUERY);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }


}
