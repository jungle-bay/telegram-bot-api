<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * Class HTTP
 * @package TelegramBotAPI\Core
 * @link https://core.telegram.org/bots/api#making-requests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class HTTP {

    const CHECK_TOKEN_PATTERN = '/^[0-9]{9}:[A-Za-z0-9\_\-]{35}$/';

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
    const ANSWER_PRE_CHECKOUT_QUERY = 'answerPreCheckoutQuery';

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
     * @var string $token
     */
    private $token;


    /**
     * @param string $response
     * @return array
     * @throws TelegramBotAPIRuntimeException
     */
    protected function parserResponse($response) {

        $data = json_decode($response, true);

        if (null !== $data) return $data;

        throw new TelegramBotAPIRuntimeException('I can not make the answer.', self::HTTP_INTERNAL_SERVER_ERROR);
    }


    /**
     * @param array $data
     * @throws TelegramBotAPIRuntimeException
     */
    protected function firewallError(array $data) {

        if (false === array_key_exists('ok', $data)) {
            throw new TelegramBotAPIRuntimeException('Something went wrong...', self::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (true === $data['ok']) return;

        $codeError = array_key_exists('error_code', $data) ? $data['error_code'] : 500;
        $messageError = array_key_exists('description', $data) ? $data['description'] : 'Error request.';

        throw new TelegramBotAPIRuntimeException($messageError, $codeError);
    }

    /**
     * @param $data
     * @throws TelegramBotAPIRuntimeException
     */
    protected function firewallResult(array $data) {

        if (true === array_key_exists('result', $data)) return;

        throw new TelegramBotAPIRuntimeException('Result no answer.', self::HTTP_INTERNAL_SERVER_ERROR);
    }


    /**
     * @param string $method
     * @return string
     * @throws TelegramBotAPIException
     */
    protected function getMethod($method) {

        $url = sprintf(self::TELEGRAM_BOT_API, $this->getToken(), $method);

        return $url;
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return mixed
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    protected function getResult($url, $parameters = array()) {

        $cURL = new Curl($url);

        $response = $cURL->post($parameters);

        $data = $this->parserResponse($response);

        $this->firewallError($data);
        $this->firewallResult($data);

        return $data['result'];
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
     * @param string $token
     * @throws TelegramBotAPIException
     */
    public function setToken($token) {

        if (false === preg_match(self::CHECK_TOKEN_PATTERN, $token)) {
            throw new TelegramBotAPIException('Telegram Bot API Token is not valid.');
        }

        $this->token = $token;
    }

    /**
     * @api
     * @return string
     * @throws TelegramBotAPIException
     */
    public function getToken() {

        if (empty($this->token)) {
            throw new TelegramBotAPIException('`token` empty');
        }

        return $this->token;
    }
}
