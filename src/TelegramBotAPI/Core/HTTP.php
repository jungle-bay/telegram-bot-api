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

    const GET = 'GET';
    const POST = 'POST';

    const HTTP_INTERNAL_SERVER_ERROR = 500;

    const TELEGRAM_BOT_API = 'https://api.telegram.org/bot%s/%s';
    const TELEGRAM_BOT_FILE = 'https://api.telegram.org/file/bot%s/%s';

    const GET_UPDATES = 'getUpdates';
    const SET_WEBHOOK = 'setWebhook';
    const DELETE_WEBHOOK = 'deleteWebhook';
    const GET_WEBHOOK_INFO = 'getWebhookInfo';

    const GET_ME = 'getMe';
    const SEND_MESSAGE = 'sendMessage';
    const FORWARD_MESSAGE = 'forwardMessage';
    const SEND_PHOTO = 'sendPhoto';
    const SEND_AUDIO = 'sendAudio';
    const SEND_DOCUMENT = 'sendDocument';
    const SEND_STICKER = 'sendSticker';
    const SEND_VIDEO = 'sendVideo';
    const SEND_VOICE = 'sendVoice';
    const SEND_VIDEO_NOTE = 'sendVideoNote';
    const SEND_LOCATION = 'sendLocation';
    const SEND_VENUE = 'sendVenue';
    const SEND_CONTACT = 'sendContact';
    const SEND_CHAT_ACTION = 'sendChatAction';
    const SEND_INVOICE = 'sendInvoice';
    const GET_USER_PROFILE_PHOTOS = 'getUserProfilePhotos';
    const GET_FILE = 'getFile';
    const KICK_CHAT_MEMBER = 'kickChatMember';
    const LEAVE_CHAT = 'leaveChat';
    const UNBAN_CHAT_MEMBER = 'unbanChatMember';
    const GET_CHAT = 'getChat';
    const GET_CHAT_ADMINISTRATORS = 'getChatAdministrators';
    const GET_CHAT_MEMBERS_COUNT = 'getChatMembersCount';
    const GET_CHAT_MEMBER = 'getChatMember';

    const EDIT_MESSAGE_TEXT = 'editMessageText';
    const EDIT_MESSAGE_CAPTION = 'editMessageCaption';
    const EDIT_MESSAGE_REPLY_MARKUP = 'editMessageReplyMarkup';
    const DELETE_MESSAGE = 'deleteMessage';

    const ANSWER_CALLBACK_QUERY = 'answerCallbackQuery';
    const ANSWER_INLINE_QUERY = 'answerInlineQuery';
    const ANSWER_SHIPPING_QUERY = 'answerShippingQuery';

    const SEND_GAME = 'sendGame';
    const SET_GAME_SCORE = 'setGameScore';
    const GET_GAME_HIGH_SCORES = 'getGameHighScores';

    const EXPORT_CHAT_INVITE_LINK = 'exportChatInviteLink';
    const SET_CHAT_PHOTO = 'setChatPhoto';
    const DELETE_CHAT_PHOTO = 'deleteChatPhoto';
    const SET_CHAT_TITLE = 'setChatTitle';
    const SET_CHAT_DESCRIPTION = 'setChatDescription';
    const PIN_CHAT_MESSAGE = 'pinChatMessage';
    const UNPIN_CHAT_MESSAGE = 'unpinChatMessage';

    const RESTRICT_CHAT_MEMBER = 'restrictChatMember';
    const PROMOTE_CHAT_MEMBER = 'promoteChatMember';

    const GET_STICKER_SET = 'getStickerSet';
    const UPLOAD_STICKER_FILE = 'uploadStickerFile';
    const CREATE_NEW_STICKER_SET = 'createNewStickerSet';
    const ADD_STICKER_TO_SET = 'addStickerToSet';
    const SET_STICKER_POSITION_IN_SET = 'setStickerPositionInSet';
    const DELETE_STICKER_FROM_SET = 'deleteStickerFromSet';

    const EDIT_MESSAGE_LIVE_LOCATION = 'editMessageLiveLocation';
    const STOP_MESSAGE_LIVE_LOCATION = 'stopMessageLiveLocation';

    const SET_CHAT_STICKER_SET = 'setChatStickerSet';
    const DELETE_CHAT_STICKER_SET = 'deleteChatStickerSet';


    /**
     * @param string $response
     * @return bool|array
     * @throws TelegramBotAPIRuntimeException
     */
    protected function checkForBadRequest($response) {

        $data = json_decode($response, true);

        if ($data === null) {
            throw new TelegramBotAPIRuntimeException('I can not spread the answer', self::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($data['ok'] !== true) {
            throw new TelegramBotAPIRuntimeException($data['description'], $data['error_code']);
        }

        return $data['result'];
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
            throw new TelegramBotAPIRuntimeException('Error request', $codeError);
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
            throw new TelegramBotAPIException('URL empty', self::HTTP_INTERNAL_SERVER_ERROR);
        }

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $parameters
        ));

        $data = $this->exec($ch);
        $response = $this->checkForBadRequest($data);

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
            throw new TelegramBotAPIException('URL empty', self::HTTP_INTERNAL_SERVER_ERROR);
        }

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_SAFE_UPLOAD    => true,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $parameters
        ));

        $data = $this->exec($ch);
        $response = $this->checkForBadRequest($data);

        return $response;
    }
}
