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
     * @param $data
     *
     * @throws TelegramBotAPIRuntimeException
     */
    private function checkDataToArray($data) {

        if (!is_array($data)) {
            throw new TelegramBotAPIRuntimeException('$data mast be array.');
        }
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

        $data = $this->checkForBadRequest($response);
        $this->checkDataToArray($data);
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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::GET, $url, array());
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::GET, $url, array());
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
            $data = $this->post($url, $payload);
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
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

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
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

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
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);
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
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

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
        $data = $this->send(TBAPrivateConst::POST, $url, $payload);
        $this->checkDataToArray($data);

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
        $result = $this->send(TBAPrivateConst::POST, $url, $payload);

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

        if (empty($parameters['text'])) {
            throw new TelegramBotAPIException('`text` is required.');
        }

        $payload = array();

        if (isset($parameters['chat_id'])) {
            $payload['chat_id'] = $parameters['chat_id'];
        }

        if (isset($parameters['message_id'])) {
            $payload['message_id'] = (int) $parameters['message_id'];
        }

        if (isset($parameters['inline_message_id'])) {
            $payload['inline_message_id'] = (string) $parameters['inline_message_id'];
        }

        $payload['text'] = (string) $parameters['text'];

        if (isset($parameters['parse_mode'])) {

            $parseMode = (string) $parameters['parse_mode'];

            if (!$this->checkParseModeType($parseMode)) {
                new TelegramBotAPIWarning('
                    Used not by the correct parse mode.
                    Send Markdown or HTML, if you want Telegram apps to show bold, italic,
                    fixed-width text or inline URLs in your bot\'s message.
                ');
            } else {
                $payload['parse_mode'] = $parseMode;
            }
        }

        if (isset($parameters['disable_web_page_preview'])) {
            $payload['disable_web_page_preview'] = (bool) $parameters['disable_web_page_preview'];
        }

        if (isset($parameters['reply_markup'])) {

            if (!$parameters['reply_markup'] instanceof InlineKeyboardMarkup) {
                new TelegramBotAPIWarning('
                    Used not by the correct object reply markup.
                    Most be InlineKeyboardMarkup.
                ');
            } else {
                $payload['reply_markup'] = json_encode($parameters['reply_markup']);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::EDIT_MESSAGE_TEXT);
        $data = $this->post($url, $payload);
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

        $payload = array();

        if (isset($parameters['chat_id'])) {
            $payload['chat_id'] = $parameters['chat_id'];
        }

        if (isset($parameters['message_id'])) {
            $payload['message_id'] = (int) $parameters['message_id'];
        }

        if (isset($parameters['inline_message_id'])) {
            $payload['inline_message_id'] = (string) $parameters['inline_message_id'];
        }

        if (isset($parameters['caption'])) {
            $payload['caption'] = $parameters['caption'];
        }

        if (isset($parameters['reply_markup'])) {

            if (!$parameters['reply_markup'] instanceof InlineKeyboardMarkup) {
                new TelegramBotAPIWarning('
                    Used not by the correct object reply markup.
                    Most be InlineKeyboardMarkup.
                ');
            } else {
                $payload['reply_markup'] = json_encode($parameters['reply_markup']);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::EDIT_MESSAGE_CAPTION);
        $data = $this->post($url, $payload);
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

        $payload = array();

        if (isset($parameters['chat_id'])) {
            $payload['chat_id'] = $parameters['chat_id'];
        }

        if (isset($parameters['message_id'])) {
            $payload['message_id'] = (int) $parameters['message_id'];
        }

        if (isset($parameters['inline_message_id'])) {
            $payload['inline_message_id'] = (string) $parameters['inline_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            if (!$parameters['reply_markup'] instanceof InlineKeyboardMarkup) {
                new TelegramBotAPIWarning('
                    Used not by the correct object reply markup.
                    Most be InlineKeyboardMarkup.
                ');
            } else {
                $payload['reply_markup'] = json_encode($parameters['reply_markup']);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::EDIT_MESSAGE_REPLY_MARKUP);
        $data = $this->post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['message_id'])) {
            throw new TelegramBotAPIException('`message_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['message_id'] = (int) $parameters['message_id'];

        $url = $this->generateUrl(TBAPrivateConst::DELETE_MESSAGE);
        $data = $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $data;
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

        if (empty($parameters['inline_query_id'])) {
            throw new TelegramBotAPIException('`inline_query_id` is required.');
        }

        if (empty($parameters['results'])) {
            throw new TelegramBotAPIException('`results` is required.');
        }

        $results = $parameters['results'];

        if (count($results) > 50) {
            throw new TelegramBotAPIException('No more than 50 results per query are allowed');
        }

        $payload = array();

        $payload['inline_query_id'] = (string) $parameters['inline_query_id'];
        $payload['results'] = json_encode($results);

        if (isset($parameters['cache_time'])) {
            $payload['cache_time'] = (int) $parameters['cache_time'];
        }

        if (isset($parameters['is_personal'])) {
            $payload['is_personal'] = (bool) $parameters['is_personal'];
        }

        if (isset($parameters['next_offset'])) {
            $payload['next_offset'] = (string) $parameters['next_offset'];
        }

        if (isset($parameters['switch_pm_text'])) {
            $payload['switch_pm_text'] = (string) $parameters['switch_pm_text'];
        }

        if (isset($parameters['switch_pm_parameter'])) {

            $switchPmParameter = (string) $parameters['switch_pm_parameter'];

            if (!preg_match(TBAPrivateConst::SWITCH_PM_PARAM_PATTERN, $switchPmParameter)) {
                throw new TelegramBotAPIException('Switch pm parameter only A-Z, a-z, 0-9, _ and - are allowed.');
            }

            $payload['switch_pm_parameter'] = $switchPmParameter;
        }

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_INLINE_QUERY);
        $result = $this->post($url, $payload);

        unset($parameters, $results, $url, $payload);

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

        if (empty($parameters['shipping_query_id'])) {
            throw new TelegramBotAPIException('`shipping_query_id` is required.');
        }

        if (empty($parameters['ok'])) {
            throw new TelegramBotAPIException('`ok` is required.');
        }

        $payload = array();

        $payload['shipping_query_id'] = $parameters['shipping_query_id'];
        $payload['ok'] = $parameters['ok'];

        foreach ($parameters['shipping_options'] as $option) {
            $payload['shipping_options'][] = $option;
        }

        if (isset($parameters['error_message'])) {
            $payload['error_message'] = $parameters['error_message'];
        }

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_SHIPPING_QUERY);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['pre_checkout_query_id'])) {
            throw new TelegramBotAPIException('`pre_checkout_query_id` is required.');
        }

        if (empty($parameters['ok'])) {
            throw new TelegramBotAPIException('`ok` is required.');
        }

        $payload = array();

        $payload['pre_checkout_query_id'] = $parameters['pre_checkout_query_id'];
        $payload['ok'] = $parameters['ok'];

        if (isset($parameters['error_message'])) {
            $payload['error_message'] = $parameters['error_message'];
        }

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_SHIPPING_QUERY);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['game_short_name'])) {
            throw new TelegramBotAPIException('`game_short_name` is required.');
        }

        $payload = array();

        $payload['chat_id'] = (int) $parameters['chat_id'];
        $payload['game_short_name'] = (string) $parameters['game_short_name'];

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            if (!$parameters['reply_markup'] instanceof InlineKeyboardMarkup) {
                new TelegramBotAPIWarning('
                    Used not by the correct object reply markup.
                    Most be InlineKeyboardMarkup.
                ');
            } else {
                $payload['reply_markup'] = json_encode($parameters['reply_markup']);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_GAME);
        $data = $this->post($url, $payload);
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

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        if (empty($parameters['score'])) {
            throw new TelegramBotAPIException('`score` is required.');
        }

        $payload = array();

        $payload['user_id'] = (int) $parameters['user_id'];

        if ($parameters['score'] < 0) {
            throw new TelegramBotAPIException('New score, must be non-negative');
        } else {
            $payload['score'] = (int) $parameters['score'];
        }

        if (isset($parameters['force'])) {
            $payload['force'] = (bool) $parameters['force'];
        }

        if (isset($parameters['disable_edit_message'])) {
            $payload['disable_edit_message'] = (bool) $parameters['disable_edit_message'];
        }

        if (isset($parameters['chat_id'])) {
            $payload['chat_id'] = (int) $parameters['chat_id'];
        }

        if (isset($parameters['message_id'])) {
            $payload['message_id'] = (int) $parameters['message_id'];
        }

        if (isset($parameters['inline_message_id'])) {
            $payload['inline_message_id'] = (string) $parameters['inline_message_id'];
        }

        $url = $this->generateUrl(TBAPrivateConst::SET_GAME_SCORE);
        $data = $this->post($url, $payload);
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

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['user_id'] = (int) $parameters['user_id'];

        if (isset($parameters['chat_id'])) {
            $payload['chat_id'] = (int) $parameters['chat_id'];
        }

        if (isset($parameters['message_id'])) {
            $payload['message_id'] = (int) $parameters['message_id'];
        }

        if (isset($parameters['inline_message_id'])) {
            $payload['inline_message_id'] = (string) $parameters['inline_message_id'];
        }

        $url = $this->generateUrl(TBAPrivateConst::GET_GAME_HIGH_SCORES);
        $data = $this->post($url, $payload);
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

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['user_id'] = (int) $parameters['user_id'];

        $url = $this->generateUrl(TBAPrivateConst::EXPORT_CHAT_INVITE_LINK);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['photo'])) {
            throw new TelegramBotAPIException('`title` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['title'] = $parameters['title'];

        $url = $this->generateUrl(TBAPrivateConst::SET_CHAT_PHOTO);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];

        $url = $this->generateUrl(TBAPrivateConst::DELETE_CHAT_PHOTO);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['title'])) {
            throw new TelegramBotAPIException('`title` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['title'] = $parameters['title'];

        $url = $this->generateUrl(TBAPrivateConst::SET_CHAT_TITLE);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['description'])) {
            throw new TelegramBotAPIException('`description` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['description'] = $parameters['description'];

        $url = $this->generateUrl(TBAPrivateConst::SET_CHAT_DESCRIPTION);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['message_id'])) {
            throw new TelegramBotAPIException('`message_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['message_id'] = $parameters['message_id'];

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        $url = $this->generateUrl(TBAPrivateConst::PIN_CHAT_MESSAGE);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];

        $url = $this->generateUrl(TBAPrivateConst::UNPIN_CHAT_MESSAGE);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['user_id'] = $parameters['user_id'];

        if (isset($parameters['until_date'])) {
            $payload['until_date'] = $parameters['until_date'];
        }

        if (isset($parameters['can_send_messages'])) {
            $payload['can_send_messages'] = $parameters['can_send_messages'];
        }

        if (isset($parameters['can_send_media_messages'])) {
            $payload['can_send_media_messages'] = $parameters['can_send_media_messages'];
        }

        if (isset($parameters['can_send_other_messages'])) {
            $payload['can_send_other_messages'] = $parameters['can_send_other_messages'];
        }

        if (isset($parameters['can_add_web_page_previews'])) {
            $payload['can_add_web_page_previews'] = $parameters['can_add_web_page_previews'];
        }

        $url = $this->generateUrl(TBAPrivateConst::RESTRICT_CHAT_MEMBER);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['user_id'] = $parameters['user_id'];

        if (isset($parameters['can_change_info'])) {
            $payload['can_change_info'] = $parameters['can_change_info'];
        }

        if (isset($parameters['can_post_messages'])) {
            $payload['can_post_messages'] = $parameters['can_post_messages'];
        }

        if (isset($parameters['can_edit_messages'])) {
            $payload['can_edit_messages'] = $parameters['can_edit_messages'];
        }

        if (isset($parameters['can_delete_messages'])) {
            $payload['can_delete_messages'] = $parameters['can_delete_messages'];
        }

        if (isset($parameters['can_invite_users'])) {
            $payload['can_invite_users'] = $parameters['can_invite_users'];
        }

        if (isset($parameters['can_restrict_members'])) {
            $payload['can_restrict_members'] = $parameters['can_restrict_members'];
        }

        if (isset($parameters['can_pin_messages'])) {
            $payload['can_pin_messages'] = $parameters['can_pin_messages'];
        }

        if (isset($parameters['can_promote_members'])) {
            $payload['can_promote_members'] = $parameters['can_promote_members'];
        }

        $url = $this->generateUrl(TBAPrivateConst::PROMOTE_CHAT_MEMBER);
        $result = $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#getstickerset
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getStickerSet(array $parameters) {

        if (empty($parameters['name'])) {
            throw new TelegramBotAPIException('`name` is required.');
        }

        $payload = array();

        $payload['name'] = $parameters['name'];

        $url = $this->generateUrl(TBAPrivateConst::GET_STICKER_SET);
        $data = $this->post($url, $payload);
        $result = new StickerSet($data);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @pai
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return string
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function uploadStickerFile(array $parameters) {

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        if (empty($parameters['png_sticker'])) {
            throw new TelegramBotAPIException('`png_sticker` is required.');
        }

        $payload = array();

        $payload['user_id'] = $parameters['user_id'];
        $payload['png_sticker'] = $parameters['png_sticker'];

        $url = $this->generateUrl(TBAPrivateConst::UPLOAD_STICKER_FILE);
        $data = $this->post($url, $payload);
        $result = new File($data);

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
    public function createNewStickerSet(array $parameters) {

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        if (empty($parameters['name'])) {
            throw new TelegramBotAPIException('`name` is required.');
        }

        if (empty($parameters['title'])) {
            throw new TelegramBotAPIException('`title` is required.');
        }

        if (empty($parameters['png_sticker'])) {
            throw new TelegramBotAPIException('`png_sticker` is required.');
        }

        if (empty($parameters['emojis'])) {
            throw new TelegramBotAPIException('`emojis` is required.');
        }

        $payload = array();

        $payload['user_id'] = $parameters['user_id'];
        $payload['name'] = $parameters['name'];
        $payload['title'] = $parameters['title'];
        $payload['png_sticker'] = $parameters['png_sticker'];
        $payload['emojis'] = $parameters['emojis'];

        if (isset($parameters['is_masks'])) {
            $payload['is_masks'] = $parameters['is_masks'];
        }

        if (isset($parameters['mask_position'])) {
            $payload['mask_position'] = $parameters['mask_position'];
        }

        $url = $this->generateUrl(TBAPrivateConst::CREATE_NEW_STICKER_SET);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        if (empty($parameters['name'])) {
            throw new TelegramBotAPIException('`name` is required.');
        }

        if (empty($parameters['png_sticker'])) {
            throw new TelegramBotAPIException('`png_sticker` is required.');
        }

        if (empty($parameters['emojis'])) {
            throw new TelegramBotAPIException('`emojis` is required.');
        }

        $payload = array();

        $payload['user_id'] = $parameters['user_id'];
        $payload['name'] = $parameters['name'];
        $payload['png_sticker'] = $parameters['png_sticker'];
        $payload['emojis'] = $parameters['emojis'];

        if (isset($parameters['mask_position'])) {
            $payload['mask_position'] = $parameters['mask_position'];
        }

        $url = $this->generateUrl(TBAPrivateConst::ADD_STICKER_TO_SET);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['sticker'])) {
            throw new TelegramBotAPIException('`sticker` is required.');
        }

        if (empty($parameters['position'])) {
            throw new TelegramBotAPIException('`position` is required.');
        }

        $payload = array();

        $payload['sticker'] = $parameters['sticker'];
        $payload['position'] = $parameters['position'];

        $url = $this->generateUrl(TBAPrivateConst::SET_STICKER_POSITION_IN_SET);
        $result = $this->post($url, $payload);

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

        if (empty($parameters['sticker'])) {
            throw new TelegramBotAPIException('`sticker` is required.');
        }

        $payload = array();

        $payload['sticker'] = $parameters['sticker'];

        $url = $this->generateUrl(TBAPrivateConst::DELETE_STICKER_FROM_SET);
        $result = $this->post($url, $payload);

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
