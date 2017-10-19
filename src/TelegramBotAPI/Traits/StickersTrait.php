<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\File;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\StickerSet;

trait StickersTrait {

    /**
     * @api
     * @param array $parameters
     * @link https://core.telegram.org/bots/api#sendsticker
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendSticker(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'sticker'              => PrivateConst::CHECK_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_STICKER);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getstickerset
     * @param array $parameters
     * @return StickerSet
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getStickerSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'name' => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::GET_STICKER_SET);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new StickerSet($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @pai
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return File
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function uploadStickerFile(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'     => PrivateConst::CHECK_REQUIRED,
            'png_sticker' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::UPLOAD_STICKER_FILE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new File($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function createNewStickerSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'user_id'       => PrivateConst::CHECK_REQUIRED,
            'name'          => PrivateConst::CHECK_REQUIRED,
            'title'         => PrivateConst::CHECK_REQUIRED,
            'png_sticker'   => PrivateConst::CHECK_REQUIRED,
            'emojis'        => PrivateConst::CHECK_REQUIRED,
            'is_masks'      => PrivateConst::CHECK_NO_REQUIRED,
            'mask_position' => PrivateConst::CHECK_NO_REQUIRED,

        ));

        $url = $this->generateUrl(PrivateConst::CREATE_NEW_STICKER_SET);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function addStickerToSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'user_id'       => PrivateConst::CHECK_REQUIRED,
            'name'          => PrivateConst::CHECK_REQUIRED,
            'png_sticker'   => PrivateConst::CHECK_REQUIRED,
            'emojis'        => PrivateConst::CHECK_REQUIRED,
            'mask_position' => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::ADD_STICKER_TO_SET);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setStickerPositionInSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'sticker'  => PrivateConst::CHECK_REQUIRED,
            'position' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_STICKER_POSITION_IN_SET);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteStickerFromSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'sticker' => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::DELETE_STICKER_FROM_SET);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }
}
