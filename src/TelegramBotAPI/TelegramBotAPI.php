<?php

namespace TelegramBotAPI;


use TelegramBotAPI\Core\HTTP;
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\User;
use TelegramBotAPI\Types\File;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\InputFile;
use TelegramBotAPI\Types\StickerSet;
use TelegramBotAPI\Types\ForceReply;
use TelegramBotAPI\Types\ChatMember;
use TelegramBotAPI\Types\WebhookInfo;
use TelegramBotAPI\Types\LabeledPrice;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\Types\UserProfilePhotos;
use TelegramBotAPI\Types\ReplyKeyboardRemove;
use TelegramBotAPI\Types\ReplyKeyboardMarkup;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\PublicConst as TBAPublicConst;
use TelegramBotAPI\PrivateConst as TBAPrivateConst;
use TelegramBotAPI\Exception\TelegramBotAPIWarning;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI
 * @link https://core.telegram.org/bots/api
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPI extends HTTP {

    /**
     * @var string $token
     */
    private $token;


    /**
     * @param array $parameters
     * @param array $fields
     * @return array
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    private function checkParameterToSend(array $parameters, array $fields) {

        $payload = array();

        foreach ($fields as $field => $howCheck) {

            switch ($howCheck) {

                case true:
                    if (empty($parameters[$field])) {
                        throw new TelegramBotAPIException($field . ' is required field.');
                    }

                    $payload[$field] = $parameters[$field];
                    break;

                case PrivateConst::CHECK_PARSE_MODE_TYPE:
                    if (!$this->checkParseModeType($parameters[$field])) {
                        new TelegramBotAPIWarning('
                            Used not by the correct parse mode.
                            Send Markdown or HTML, if you want Telegram apps to show bold, italic,
                            fixed-width text or inline URLs in your bot\'s message.
                        ');
                    }

                    $payload[$field] = $parameters[$field];
                    break;

                case PrivateConst::CHECK_KEYBOARD_TYPE:
                    if (!$this->checkKeyboardType($parameters[$field])) {
                        new TelegramBotAPIWarning('Invalid keyboard type.');
                    }

                    $payload[$field] = json_encode($parameters[$field]);
                    break;

                case PrivateConst::CHECK_ACTION_TYPE:
                    if (!$this->checkActionType($parameters[$field])) {
                        new TelegramBotAPIWarning('Invalid action type.');
                    }

                    $payload[$field] = $parameters[$field];
                    break;

                case PrivateConst::CHECK_LIMIT:
                    if (!$this->checkLimit($parameters[$field])) {
                        new TelegramBotAPIWarning('
                            Used not by the correct limit limits the number of updates that are updated.
                            Values from 1 to 100 are accepted. Default is 100.
                        ');
                    }

                    $payload[$field] = $parameters[$field];
                    break;

                case PrivateConst::CHECK_CAPTION_LIMIT:
                    if (!$this->checkCaptionLimit($parameters[$field])) {
                        new TelegramBotAPIWarning('
                            Used not by the correct limit.
                            Photo caption (may also be used when resending photos by file_id),
                            0-200 characters.
                        ');
                    }

                    $payload[$field] = $parameters[$field];
                    break;

                default:
                    if (isset($parameters[$field])) {
                        $payload[$field] = $parameters[$field];
                    }

                    break;

            }
        }

        return $payload;
    }

    /**
     * @param string $response
     * @return bool|array
     * @throws TelegramBotAPIRuntimeException
     */
    private function checkForBadRequest($response) {

        $data = json_decode($response, true);

        if ($data === null) {
            throw new TelegramBotAPIRuntimeException('I can not spread the answer', self::INTERNAL_SERVER_ERROR);
        }

        if ($data['ok'] !== true) {
            throw new TelegramBotAPIRuntimeException($data['description'], $data['error_code']);
        }

        return $data['result'];
    }

    private function send($method, $url, $payload) {

        if ($method === TBAPrivateConst::POST) {
            $response = $this->post($url, $payload);
        } else {
            $response = $this->get($url, $payload);
        }

        $data = $this->checkForBadRequest($response);

        return $data;
    }

    /**
     * @param $keyboard
     * @return bool
     */
    private function checkKeyboardType($keyboard) {

        switch (true) {

            case $keyboard instanceof InlineKeyboardMarkup:
            case $keyboard instanceof ReplyKeyboardMarkup:
            case $keyboard instanceof ReplyKeyboardRemove:
            case $keyboard instanceof ForceReply:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param string $actionType
     * @return bool
     */
    private function checkActionType($actionType) {

        switch ($actionType) {

            case TBAPublicConst::TYPING_TYPE_ACTION:
            case TBAPublicConst::UPLOAD_PHOTO_TYPE_ACTION:
            case TBAPublicConst::RECORD_VIDEO_TYPE_ACTION:
            case TBAPublicConst::UPLOAD_VIDEO_TYPE_ACTION:
            case TBAPublicConst::RECORD_AUDIO_TYPE_ACTION:
            case TBAPublicConst::UPLOAD_AUDIO_TYPE_ACTION:
            case TBAPublicConst::UPLOAD_DOCUMENT_TYPE_ACTION:
            case TBAPublicConst::FIND_LOCATION_TYPE_ACTION:
            case TBAPublicConst::RECORD_VIDEO_NOTE:
            case TBAPublicConst::UPLOAD_VIDEO_NOTE:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param int $caption
     * @return bool
     */
    private function checkCaptionLimit($caption) {
        return (($caption > TBAPrivateConst::CAPTION_MIN_SIZE) && (TBAPrivateConst::CAPTION_MAX_SIZE < $caption));
    }

    /**
     * @param int $limit
     * @return bool
     */
    private function checkLimit($limit) {
        return (($limit > TBAPrivateConst::LIMIT_MIN) && (TBAPrivateConst::LIMIT_MAX < $limit));
    }

    /**
     * @param string $mode
     * @return bool
     */
    private function checkParseModeType($mode) {
        return ((TBAPublicConst::HTML_PARSE_MODE === $mode) || (TBAPublicConst::MARKDOWN_PARSE_MODE === $mode));
    }

    /**
     * @param string $method
     * @return string
     */
    private function generateUrl($method) {

        $url = sprintf(TBAPrivateConst::TELEGRAM_BOT_API, $this->getToken(), $method);

        return $url;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
     * @param string $token
     *
     * @throws TelegramBotAPIException
     */
    public function setToken($token) {

        if (!preg_match(TBAPrivateConst::CHECK_TOKEN_PATTERN, $token)) {
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
     * @api
     * @link https://core.telegram.org/bots/api#getting-updates
     * @param string $response
     * @return Update[]
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function takeUpdates($response) {

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

        $payload = $this->checkParameterToSend($parameters, array(
            'offset'          => false,
            'limit'           => false,
            'timeout'         => TBAPrivateConst::CHECK_LIMIT,
            'allowed_updates' => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_UPDATES);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameterToSend($parameters, array(
            'url'             => true,
            'certificate'     => false,
            'max_connections' => TBAPrivateConst::CHECK_LIMIT,
            'allowed_updates' => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::SET_WEBHOOK);
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

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

        $url = $this->generateUrl(TBAPrivateConst::DELETE_WEBHOOK);
        $result = $this->send(TBAPrivateConst::GET, $url, array());

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

        $url = $this->generateUrl(TBAPrivateConst::GET_WEBHOOK_INFO);
        $data = (array) $this->send(TBAPrivateConst::GET, $url, array());

        $result = new WebhookInfo($data);

        unset($url, $data);

        return $result;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#getme
     * @return User
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function getMe() {

        $url = $this->generateUrl(TBAPrivateConst::GET_ME);
        $data = (array) $this->send(TBAPrivateConst::GET, $url, array());

        $result = new User($data);

        unset($url, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendmessage
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendMessage(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'                  => true,
            'text'                     => true,
            'parse_mode'               => PrivateConst::CHECK_PARSE_MODE_TYPE,
            'disable_web_page_preview' => false,
            'disable_notification'     => false,
            'reply_to_message_id'      => false,
            'reply_markup'             => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_MESSAGE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @param array $parameters
     * @link https://core.telegram.org/bots/api#forwardmessage
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function forwardMessage(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'from_chat_id'         => true,
            'message_id'           => true,
            'disable_notification' => false,
        ));

        $url = $this->generateUrl(TBAPrivateConst::FORWARD_MESSAGE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendphoto
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendPhoto(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'photo'                => true,
            'caption'              => PrivateConst::CHECK_CAPTION_LIMIT,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_PHOTO);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendaudio
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendAudio(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'audio'                => true,
            'caption'              => PrivateConst::CHECK_CAPTION_LIMIT,
            'duration'             => false,
            'performer'            => false,
            'title'                => false,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_AUDIO);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#senddocument
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendDocument(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'document'             => true,
            'caption'              => PrivateConst::CHECK_CAPTION_LIMIT,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_DOCUMENT);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

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

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'sticker'              => true,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_STICKER);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvideo
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVideo(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'video'                => true,
            'duration'             => false,
            'width'                => false,
            'height'               => false,
            'caption'              => PrivateConst::CHECK_CAPTION_LIMIT,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_VIDEO);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvoice
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVoice(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'voice'                => true,
            'caption'              => PrivateConst::CHECK_CAPTION_LIMIT,
            'duration'             => false,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_VOICE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvideonote
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVideoNote(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'video_note'           => true,
            'duration'             => false,
            'length'               => false,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_VIDEO_NOTE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendlocation
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendLocation(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'latitude'             => true,
            'longitude'            => true,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_LOCATION);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvenue
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVenue(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'latitude'             => true,
            'longitude'            => true,
            'title'                => true,
            'address'              => true,
            'foursquare_id'        => false,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_VENUE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendcontact
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendContact(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'phone_number'         => true,
            'first_name'           => true,
            'last_name'            => false,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_CONTACT);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendchataction
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendChatAction(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
            'action'  => PrivateConst::CHECK_ACTION_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_CHAT_ACTION);
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

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

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'               => true,
            'title'                 => true,
            'description'           => true,
            'payload'               => true,
            'provider_token'        => true,
            'start_parameter'       => true,
            'currency'              => true,
            'prices'                => true,
            'photo_url'             => false,
            'photo_size'            => false,
            'photo_width'           => false,
            'photo_height'          => false,
            'need_name'             => false,
            'need_phone_number'     => false,
            'need_email'            => false,
            'need_shipping_address' => false,
            'is_flexible'           => false,
            'disable_notification'  => false,
            'reply_to_message_id'   => false,
            'reply_markup'          => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_INVOICE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     * @param array $parameters
     * @return UserProfilePhotos
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getUserProfilePhotos(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'user_id' => true,
            'offset'  => false,
            'limit'   => PrivateConst::CHECK_LIMIT
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_USER_PROFILE_PHOTOS);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new UserProfilePhotos($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getfile
     * @param array $parameters
     * @return File|string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getFile(array $parameters) {

        if (empty($parameters['file_path'])) {

            if (empty($parameters['file_id'])) {
                throw new TelegramBotAPIException('`file_id` is required.');
            }

            $payload = array();

            $payload['file_id'] = (string) $parameters['file_id'];

            $url = $this->generateUrl(TBAPrivateConst::GET_FILE);
            $data = $this->send(PrivateConst::POST, $url, $payload);
            $result = new File($data);

            unset($parameters, $url, $payload, $data);

        } else {

            $url = sprintf(TBAPrivateConst::TELEGRAM_BOT_FILE, $this->getToken(), $parameters['file_path']);
            $result = file_get_contents($url);

            unset($url);
        }

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#kickchatmember
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function kickChatMember(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'    => true,
            'user_id'    => true,
            'until_date' => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::KICK_CHAT_MEMBER);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#leavechat
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function leaveChat(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::LEAVE_CHAT);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#unbanchatmember
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function unbanChatMember(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
            'user_id' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::UNBAN_CHAT_MEMBER);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchat
     * @param array $parameters
     * @return Chat
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChat(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Chat($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchatadministrators
     * @param array $parameters
     * @return ChatMember[]
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChatAdministrators(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT_ADMINISTRATORS);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = array();

        foreach ($data as $obj) {
            $result[] = new ChatMember($obj);
        }

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     * @param array $parameters
     * @return int
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChatMembersCount(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT_MEMBERS_COUNT);
        $result = (int) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchatmember
     * @param array $parameters
     * @return ChatMember
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChatMember(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
            'user_id' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT_MEMBER);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new ChatMember($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answercallbackquery
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerCallbackQuery(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'callback_query_id' => true,
            'text'              => PrivateConst::CHECK_CAPTION_LIMIT,
            'show_alert'        => false,
            'url'               => false,
            'cache_time'        => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_CALLBACK_QUERY);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagetext
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageText(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'text'                     => true,
            'chat_id'                  => false,
            'message_id'               => false,
            'inline_message_id'        => false,
            'parse_mode'               => PrivateConst::CHECK_PARSE_MODE_TYPE,
            'disable_web_page_preview' => false,
            'reply_markup'             => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::EDIT_MESSAGE_TEXT);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagecaption
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageCaption(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'           => false,
            'message_id'        => false,
            'inline_message_id' => false,
            'caption'           => PrivateConst::CHECK_CAPTION_LIMIT,
            'reply_markup'      => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::EDIT_MESSAGE_CAPTION);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageReplyMarkup(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'           => false,
            'message_id'        => false,
            'inline_message_id' => false,
            'reply_markup'      => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::EDIT_MESSAGE_REPLY_MARKUP);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deleteMessage
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteMessage(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'    => true,
            'message_id' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::DELETE_MESSAGE);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#answerinlinequery
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerInlineQuery(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'inline_query_id'     => true,
            'results'             => true,
            'cache_time'          => false,
            'is_personal'         => false,
            'next_offset'         => false,
            'switch_pm_text'      => false,
            'switch_pm_parameter' => false
        ));

        if (count($payload['results']) > 50) {
            throw new TelegramBotAPIException('No more than 50 results per query are allowed');
        }

        $payload['results'] = json_encode($payload['results']);

        if (!preg_match(TBAPrivateConst::SWITCH_PM_PARAM_PATTERN, $payload['switch_pm_parameter'])) {
            throw new TelegramBotAPIException('Switch pm parameter only A-Z, a-z, 0-9, _ and - are allowed.');
        }

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_INLINE_QUERY);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

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

        $payload = $this->checkParameterToSend($parameters, array(
            'shipping_query_id' => true,
            'ok'                => true,
            'shipping_options'  => false,
            'error_message'     => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_SHIPPING_QUERY);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameterToSend($parameters, array(
            'pre_checkout_query_id' => true,
            'ok'                    => true,
            'error_message'         => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_SHIPPING_QUERY);
        $result = (bool) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }


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

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'game_short_name'      => true,
            'disable_notification' => false,
            'reply_to_message_id'  => false,
            'reply_markup'         => PrivateConst::CHECK_KEYBOARD_TYPE
        ));

        $url = $this->generateUrl(TBAPrivateConst::SEND_GAME);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameterToSend($parameters, array(
            'user_id'              => true,
            'score'                => true,
            'force'                => false,
            'disable_edit_message' => false,
            'chat_id'              => false,
            'message_id'           => false,
            'inline_message_id'    => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::SET_GAME_SCORE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameterToSend($parameters, array(
            'user_id'           => true,
            'chat_id'           => false,
            'message_id'        => false,
            'inline_message_id' => false,
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_GAME_HIGH_SCORES);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
        $result = array();

        foreach ($data as $obj) {
            $result[] = new GameHighScore($obj);
        }

        unset($parameters, $url, $payload, $data);

        return $result;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function exportChatInviteLink(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'user_id' => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::EXPORT_CHAT_INVITE_LINK);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatphoto
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatPhoto(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
            'photo'   => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::SET_CHAT_PHOTO);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletechatphoto
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteChatPhoto(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::DELETE_CHAT_PHOTO);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchattitle
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatTitle(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true,
            'title'   => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::SET_CHAT_TITLE);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatdescription
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatDescription(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'     => true,
            'description' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::SET_CHAT_DESCRIPTION);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#pinchatmessage
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function pinChatMessage(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'message_id'           => true,
            'disable_notification' => false,
        ));

        $url = $this->generateUrl(TBAPrivateConst::PIN_CHAT_MESSAGE);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function unpinChatMessage(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::UNPIN_CHAT_MESSAGE);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#restrictchatmember
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function restrictChatMember(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'                   => true,
            'user_id'                   => true,
            'until_date'                => false,
            'can_send_messages'         => false,
            'can_send_media_messages'   => false,
            'can_send_other_messages'   => false,
            'can_add_web_page_previews' => false,
        ));

        $url = $this->generateUrl(TBAPrivateConst::RESTRICT_CHAT_MEMBER);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

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
    public function promoteChatMember(array $parameters) {

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'              => true,
            'user_id'              => true,
            'can_change_info'      => false,
            'can_post_messages'    => false,
            'can_edit_messages'    => false,
            'can_delete_messages'  => false,
            'can_invite_users'     => false,
            'can_restrict_members' => false,
            'can_pin_messages'     => false,
            'can_promote_members'  => false,
        ));

        $url = $this->generateUrl(TBAPrivateConst::PROMOTE_CHAT_MEMBER);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

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

        $payload = $this->checkParameterToSend($parameters, array(
            'name' => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::GET_STICKER_SET);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameterToSend($parameters, array(
            'chat_id'     => true,
            'png_sticker' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::UPLOAD_STICKER_FILE);
        $data = (array) $this->send(TBAPrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameterToSend($parameters, array(
            'user_id'       => true,
            'name'          => true,
            'title'         => true,
            'png_sticker'   => true,
            'emojis'        => true,
            'is_masks'      => false,
            'mask_position' => false,

        ));

        $url = $this->generateUrl(TBAPrivateConst::CREATE_NEW_STICKER_SET);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameterToSend($parameters, array(
            'user_id'       => true,
            'name'          => true,
            'png_sticker'   => true,
            'emojis'        => true,
            'mask_position' => false
        ));

        $url = $this->generateUrl(TBAPrivateConst::ADD_STICKER_TO_SET);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameterToSend($parameters, array(
            'sticker'  => true,
            'position' => true
        ));

        $url = $this->generateUrl(TBAPrivateConst::SET_STICKER_POSITION_IN_SET);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameterToSend($parameters, array(
            'sticker' => true,
        ));

        $url = $this->generateUrl(TBAPrivateConst::DELETE_STICKER_FROM_SET);
        $result = (string) $this->send(TBAPrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
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
