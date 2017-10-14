<?php

namespace TelegramBotAPI;


use TelegramBotAPI\Core\HTTP;
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\User;
use TelegramBotAPI\Types\File;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\StickerSet;
use TelegramBotAPI\Types\ChatMember;
use TelegramBotAPI\Types\WebhookInfo;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\Types\UserProfilePhotos;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI
 * @link https://core.telegram.org/bots/api
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPI extends HTTP {

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


    /**
     * @api
     * @link https://core.telegram.org/bots/api#getme
     * @return User
     *
     * @throws TelegramBotAPIRuntimeException
     */
    public function getMe() {

        $url = $this->generateUrl(PrivateConst::GET_ME);
        $data = (array) $this->send(PrivateConst::GET, $url, array());

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'                  => PrivateConst::CHECK_REQUIRED,
            'text'                     => PrivateConst::CHECK_REQUIRED,
            'parse_mode'               => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_PARSE_MODE_TYPE
            ),
            'disable_web_page_preview' => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification'     => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'      => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'             => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_MESSAGE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'from_chat_id'         => PrivateConst::CHECK_REQUIRED,
            'message_id'           => PrivateConst::CHECK_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::FORWARD_MESSAGE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'photo'                => PrivateConst::CHECK_REQUIRED,
            'caption'              => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_PHOTO);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'audio'                => PrivateConst::CHECK_REQUIRED,
            'caption'              => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'duration'             => PrivateConst::CHECK_NO_REQUIRED,
            'performer'            => PrivateConst::CHECK_NO_REQUIRED,
            'title'                => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_AUDIO);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'document'             => PrivateConst::CHECK_REQUIRED,
            'caption'              => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_DOCUMENT);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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
     * @link https://core.telegram.org/bots/api#sendvideo
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVideo(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'video'                => PrivateConst::CHECK_REQUIRED,
            'duration'             => PrivateConst::CHECK_NO_REQUIRED,
            'width'                => PrivateConst::CHECK_NO_REQUIRED,
            'height'               => PrivateConst::CHECK_NO_REQUIRED,
            'caption'              => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_VIDEO);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'voice'                => PrivateConst::CHECK_REQUIRED,
            'caption'              => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'duration'             => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_VOICE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'video_note'           => PrivateConst::CHECK_REQUIRED,
            'duration'             => PrivateConst::CHECK_NO_REQUIRED,
            'length'               => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_VIDEO_NOTE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'latitude'             => PrivateConst::CHECK_REQUIRED,
            'longitude'            => PrivateConst::CHECK_REQUIRED,
            'live_period'          => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_LOCATION
            ),
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_LOCATION);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'latitude'             => PrivateConst::CHECK_REQUIRED,
            'longitude'            => PrivateConst::CHECK_REQUIRED,
            'title'                => PrivateConst::CHECK_REQUIRED,
            'address'              => PrivateConst::CHECK_REQUIRED,
            'foursquare_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_VENUE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'phone_number'         => PrivateConst::CHECK_REQUIRED,
            'first_name'           => PrivateConst::CHECK_REQUIRED,
            'last_name'            => PrivateConst::CHECK_NO_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_CONTACT);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
            'action'  => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_ACTION_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_CHAT_ACTION);
        $result = $this->send(PrivateConst::POST, $url, $payload);

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
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     * @param array $parameters
     * @return UserProfilePhotos
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getUserProfilePhotos(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'user_id' => PrivateConst::CHECK_REQUIRED,
            'offset'  => PrivateConst::CHECK_NO_REQUIRED,
            'limit'   => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_LIMIT
            )
        ));

        $url = $this->generateUrl(PrivateConst::GET_USER_PROFILE_PHOTOS);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

            $url = $this->generateUrl(PrivateConst::GET_FILE);
            $data = (array) $this->send(PrivateConst::POST, $url, $payload);
            $result = new File($data);

            unset($parameters, $url, $payload, $data);

        } else {

            $url = sprintf(PrivateConst::TELEGRAM_BOT_FILE, $this->getToken(), $parameters['file_path']);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'    => PrivateConst::CHECK_REQUIRED,
            'user_id'    => PrivateConst::CHECK_REQUIRED,
            'until_date' => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::KICK_CHAT_MEMBER);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::LEAVE_CHAT);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
            'user_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::UNBAN_CHAT_MEMBER);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::GET_CHAT);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::GET_CHAT_ADMINISTRATORS);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::GET_CHAT_MEMBERS_COUNT);
        $result = (int) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
            'user_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::GET_CHAT_MEMBER);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'callback_query_id' => PrivateConst::CHECK_REQUIRED,
            'text'              => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'show_alert'        => PrivateConst::CHECK_NO_REQUIRED,
            'url'               => PrivateConst::CHECK_NO_REQUIRED,
            'cache_time'        => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::ANSWER_CALLBACK_QUERY);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'text'                     => PrivateConst::CHECK_REQUIRED,
            'chat_id'                  => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'               => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'parse_mode'               => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_PARSE_MODE_TYPE
            ),
            'disable_web_page_preview' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'             => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_TEXT);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
            'caption'           => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_CAPTION_LIMIT
            ),
            'reply_markup'      => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_CAPTION);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'      => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_REPLY_MARKUP);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'    => PrivateConst::CHECK_REQUIRED,
            'message_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::DELETE_MESSAGE);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'inline_query_id'     => PrivateConst::CHECK_REQUIRED,
            'results'             => PrivateConst::CHECK_REQUIRED,
            'cache_time'          => PrivateConst::CHECK_NO_REQUIRED,
            'is_personal'         => PrivateConst::CHECK_NO_REQUIRED,
            'next_offset'         => PrivateConst::CHECK_NO_REQUIRED,
            'switch_pm_text'      => PrivateConst::CHECK_NO_REQUIRED,
            'switch_pm_parameter' => PrivateConst::CHECK_NO_REQUIRED
        ));

        if (count($payload['results']) > 50) {
            throw new TelegramBotAPIException('No more than 50 results per query are allowed');
        }

        $payload['results'] = json_encode($payload['results']);

        if (!preg_match(PrivateConst::SWITCH_PM_PARAM_PATTERN, $payload['switch_pm_parameter'])) {
            throw new TelegramBotAPIException('Switch pm parameter only A-Z, a-z, 0-9, _ and - are allowed.');
        }

        $url = $this->generateUrl(PrivateConst::ANSWER_INLINE_QUERY);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'game_short_name'      => PrivateConst::CHECK_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::SEND_GAME);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'user_id'              => PrivateConst::CHECK_REQUIRED,
            'score'                => PrivateConst::CHECK_REQUIRED,
            'force'                => PrivateConst::CHECK_NO_REQUIRED,
            'disable_edit_message' => PrivateConst::CHECK_NO_REQUIRED,
            'chat_id'              => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id'    => PrivateConst::CHECK_NO_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_GAME_SCORE);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'user_id'           => PrivateConst::CHECK_REQUIRED,
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::GET_GAME_HIGH_SCORES);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
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

        $payload = $this->checkParameter($parameters, array(
            'user_id' => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::EXPORT_CHAT_INVITE_LINK);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
            'photo'   => PrivateConst::CHECK_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::SET_CHAT_PHOTO);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::DELETE_CHAT_PHOTO);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED,
            'title'   => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_CHAT_TITLE);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'     => PrivateConst::CHECK_REQUIRED,
            'description' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_CHAT_DESCRIPTION);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'message_id'           => PrivateConst::CHECK_REQUIRED,
            'disable_notification' => PrivateConst::CHECK_NO_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::PIN_CHAT_MESSAGE);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::UNPIN_CHAT_MESSAGE);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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

        $payload = $this->checkParameter($parameters, array(
            'chat_id'                   => PrivateConst::CHECK_REQUIRED,
            'user_id'                   => PrivateConst::CHECK_REQUIRED,
            'until_date'                => PrivateConst::CHECK_NO_REQUIRED,
            'can_send_messages'         => PrivateConst::CHECK_NO_REQUIRED,
            'can_send_media_messages'   => PrivateConst::CHECK_NO_REQUIRED,
            'can_send_other_messages'   => PrivateConst::CHECK_NO_REQUIRED,
            'can_add_web_page_previews' => PrivateConst::CHECK_NO_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::RESTRICT_CHAT_MEMBER);
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
    public function promoteChatMember(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'              => PrivateConst::CHECK_REQUIRED,
            'user_id'              => PrivateConst::CHECK_REQUIRED,
            'can_change_info'      => PrivateConst::CHECK_NO_REQUIRED,
            'can_post_messages'    => PrivateConst::CHECK_NO_REQUIRED,
            'can_edit_messages'    => PrivateConst::CHECK_NO_REQUIRED,
            'can_delete_messages'  => PrivateConst::CHECK_NO_REQUIRED,
            'can_invite_users'     => PrivateConst::CHECK_NO_REQUIRED,
            'can_restrict_members' => PrivateConst::CHECK_NO_REQUIRED,
            'can_pin_messages'     => PrivateConst::CHECK_NO_REQUIRED,
            'can_promote_members'  => PrivateConst::CHECK_NO_REQUIRED,
        ));

        $url = $this->generateUrl(PrivateConst::PROMOTE_CHAT_MEMBER);
        $result = (string) $this->send(PrivateConst::POST, $url, $payload);

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


    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageLiveLocation(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
            'latitude'          => PrivateConst::CHECK_REQUIRED,
            'longitude'         => PrivateConst::CHECK_REQUIRED,
            'reply_markup'      => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::EDIT_MESSAGE_LIVE_LOCATION);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     * @param array $parameters
     * @return Message
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function stopMessageLiveLocation(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'           => PrivateConst::CHECK_NO_REQUIRED,
            'message_id'        => PrivateConst::CHECK_NO_REQUIRED,
            'inline_message_id' => PrivateConst::CHECK_NO_REQUIRED,
            'reply_markup'      => array(
                'required' => PrivateConst::CHECK_NO_REQUIRED,
                'type'     => PrivateConst::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->generateUrl(PrivateConst::STOP_MESSAGE_LIVE_LOCATION);
        $data = (array) $this->send(PrivateConst::POST, $url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatstickerset
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatStickerSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id'          => PrivateConst::CHECK_REQUIRED,
            'sticker_set_name' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::SET_CHAT_STICKER_SET);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteChatStickerSet(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'chat_id' => PrivateConst::CHECK_REQUIRED
        ));

        $url = $this->generateUrl(PrivateConst::DELETE_CHAT_STICKER_SET);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }
}
