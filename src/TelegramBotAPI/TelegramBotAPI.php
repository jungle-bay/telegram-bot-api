<?php

namespace TelegramBotAPI;


use TelegramBotAPI\Core\HTTP;
use TelegramBotAPI\Types\LabeledPrice;
use TelegramBotAPI\Types\User;
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\File;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Traits\UrlTrait;
use TelegramBotAPI\Types\ChatMember;
use TelegramBotAPI\Types\StickerSet;
use TelegramBotAPI\Types\WebhookInfo;
use TelegramBotAPI\Supports\Validator;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\Traits\ParametersTrait;
use TelegramBotAPI\Types\UserProfilePhotos;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * @package TelegramBotAPI
 * @link https://core.telegram.org/bots/api
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPI extends HTTP {

    use UrlTrait;
    use ParametersTrait;


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

        $url = $this->getUrl(self::GET_UPDATES);
        $parameters = $this->getParameters($parameters, array(
            'offset'          => Validator::CHECK_NO_REQUIRED,
            'limit'           => Validator::CHECK_NO_REQUIRED,
            'timeout'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_LIMIT
            ),
            'allowed_updates' => Validator::CHECK_NO_REQUIRED
        ));

        $response = (array) $this->post($url, $parameters);
        $data = array();

        foreach ($response as $obj) {
            $data[] = new Update($obj);
        }

        unset($url, $parameters, $response);

        return $data;
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

        $url = $this->getUrl(self::SET_WEBHOOK);
        $payload = $this->getParameters($parameters, array(
            'url'             => Validator::CHECK_REQUIRED,
            'certificate'     => Validator::CHECK_NO_REQUIRED,
            'max_connections' => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_LIMIT
            ),
            'allowed_updates' => Validator::CHECK_NO_REQUIRED
        ));

        $result = $this->post($url, $payload);

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

        $url = $this->getUrl(self::DELETE_WEBHOOK);
        $result = $this->get($url, array());

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

        $url = $this->getUrl(self::GET_WEBHOOK_INFO);
        $data = (array) $this->get($url, array());

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

        $url = $this->getUrl(self::GET_ME);
        $data = (array) $this->get($url, array());

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

        $parameters = $this->getParameters($parameters, array(
            'chat_id'                  => Validator::CHECK_REQUIRED,
            'text'                     => Validator::CHECK_REQUIRED,
            'parse_mode'               => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_PARSE_MODE_TYPE
            ),
            'disable_web_page_preview' => Validator::CHECK_NO_REQUIRED,
            'disable_notification'     => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'      => Validator::CHECK_NO_REQUIRED,
            'reply_markup'             => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_MESSAGE);
        $data = (array) $this->post($url, $parameters);
        $result = new Message($data);

        unset($parameters, $url, $data);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'from_chat_id'         => Validator::CHECK_REQUIRED,
            'message_id'           => Validator::CHECK_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
        ));

        $url = $this->getUrl(self::FORWARD_MESSAGE);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'photo'                => Validator::CHECK_REQUIRED,
            'caption'              => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_PHOTO);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'audio'                => Validator::CHECK_REQUIRED,
            'caption'              => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'duration'             => Validator::CHECK_NO_REQUIRED,
            'performer'            => Validator::CHECK_NO_REQUIRED,
            'title'                => Validator::CHECK_NO_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_AUDIO);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'document'             => Validator::CHECK_REQUIRED,
            'caption'              => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_DOCUMENT);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'video'                => Validator::CHECK_REQUIRED,
            'duration'             => Validator::CHECK_NO_REQUIRED,
            'width'                => Validator::CHECK_NO_REQUIRED,
            'height'               => Validator::CHECK_NO_REQUIRED,
            'caption'              => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_VIDEO);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'voice'                => Validator::CHECK_REQUIRED,
            'caption'              => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'duration'             => Validator::CHECK_NO_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_VOICE);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'video_note'           => Validator::CHECK_REQUIRED,
            'duration'             => Validator::CHECK_NO_REQUIRED,
            'length'               => Validator::CHECK_NO_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_VIDEO_NOTE);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'latitude'             => Validator::CHECK_REQUIRED,
            'longitude'            => Validator::CHECK_REQUIRED,
            'live_period'          => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_LOCATION
            ),
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_LOCATION);
        $data = (array) $this->post($url, $payload);
        $result = new Message($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     * @param array $parameters
     * @return Message|bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageLiveLocation(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'           => Validator::CHECK_NO_REQUIRED,
            'message_id'        => Validator::CHECK_NO_REQUIRED,
            'inline_message_id' => Validator::CHECK_NO_REQUIRED,
            'latitude'          => Validator::CHECK_REQUIRED,
            'longitude'         => Validator::CHECK_REQUIRED,
            'reply_markup'      => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::EDIT_MESSAGE_LIVE_LOCATION);
        $data = $this->post($url, $payload);

        if (is_array($data)) {
            $result = new Message($data);
        } else {
            $result = $data;
        }

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     * @param array $parameters
     * @return Message|bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function stopMessageLiveLocation(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'           => Validator::CHECK_NO_REQUIRED,
            'message_id'        => Validator::CHECK_NO_REQUIRED,
            'inline_message_id' => Validator::CHECK_NO_REQUIRED,
            'reply_markup'      => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::STOP_MESSAGE_LIVE_LOCATION);
        $data = $this->post($url, $payload);

        if (is_array($data)) {
            $result = new Message($data);
        } else {
            $result = $data;
        }

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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'latitude'             => Validator::CHECK_REQUIRED,
            'longitude'            => Validator::CHECK_REQUIRED,
            'title'                => Validator::CHECK_REQUIRED,
            'address'              => Validator::CHECK_REQUIRED,
            'foursquare_id'        => Validator::CHECK_NO_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_VENUE);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'phone_number'         => Validator::CHECK_REQUIRED,
            'first_name'           => Validator::CHECK_REQUIRED,
            'last_name'            => Validator::CHECK_NO_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_CONTACT);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
            'action'  => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_ACTION_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_CHAT_ACTION);
        $result = $this->post($url, $payload);

        unset($parameters, $url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'user_id' => Validator::CHECK_REQUIRED,
            'offset'  => Validator::CHECK_NO_REQUIRED,
            'limit'   => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_LIMIT
            )
        ));

        $url = $this->getUrl(self::GET_USER_PROFILE_PHOTOS);
        $data = (array) $this->post($url, $payload);
        $result = new UserProfilePhotos($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getfile
     * @param array $parameters
     * @return File|bool|string
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

            $url = $this->getUrl(self::GET_FILE);
            $data = (array) $this->post($url, $payload);
            $result = new File($data);

            unset($parameters, $url, $payload, $data);

        } else {

            $url = sprintf(self::TELEGRAM_BOT_FILE, $this->getToken(), $parameters['file_path']);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'    => Validator::CHECK_REQUIRED,
            'user_id'    => Validator::CHECK_REQUIRED,
            'until_date' => Validator::CHECK_NO_REQUIRED
        ));

        $url = $this->getUrl(self::KICK_CHAT_MEMBER);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
            'user_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::UNBAN_CHAT_MEMBER);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#restrictchatmember
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function restrictChatMember(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'                   => Validator::CHECK_REQUIRED,
            'user_id'                   => Validator::CHECK_REQUIRED,
            'until_date'                => Validator::CHECK_NO_REQUIRED,
            'can_send_messages'         => Validator::CHECK_NO_REQUIRED,
            'can_send_media_messages'   => Validator::CHECK_NO_REQUIRED,
            'can_send_other_messages'   => Validator::CHECK_NO_REQUIRED,
            'can_add_web_page_previews' => Validator::CHECK_NO_REQUIRED,
        ));

        $url = $this->getUrl(self::RESTRICT_CHAT_MEMBER);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function promoteChatMember(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'user_id'              => Validator::CHECK_REQUIRED,
            'can_change_info'      => Validator::CHECK_NO_REQUIRED,
            'can_post_messages'    => Validator::CHECK_NO_REQUIRED,
            'can_edit_messages'    => Validator::CHECK_NO_REQUIRED,
            'can_delete_messages'  => Validator::CHECK_NO_REQUIRED,
            'can_invite_users'     => Validator::CHECK_NO_REQUIRED,
            'can_restrict_members' => Validator::CHECK_NO_REQUIRED,
            'can_pin_messages'     => Validator::CHECK_NO_REQUIRED,
            'can_promote_members'  => Validator::CHECK_NO_REQUIRED,
        ));

        $url = $this->getUrl(self::PROMOTE_CHAT_MEMBER);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::EXPORT_CHAT_INVITE_LINK);
        $result = (string) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatphoto
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatPhoto(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
            'photo'   => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::SET_CHAT_PHOTO);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletechatphoto
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteChatPhoto(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::DELETE_CHAT_PHOTO);
        $result = (string) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchattitle
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatTitle(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
            'title'   => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::SET_CHAT_TITLE);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatdescription
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatDescription(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'     => Validator::CHECK_REQUIRED,
            'description' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::SET_CHAT_DESCRIPTION);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#pinchatmessage
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function pinChatMessage(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'message_id'           => Validator::CHECK_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
        ));

        $url = $this->getUrl(self::PIN_CHAT_MESSAGE);
        $result = (string) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function unpinChatMessage(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::UNPIN_CHAT_MESSAGE);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::LEAVE_CHAT);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::GET_CHAT);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::GET_CHAT_ADMINISTRATORS);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::GET_CHAT_MEMBERS_COUNT);
        $result = (int) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED,
            'user_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::GET_CHAT_MEMBER);
        $data = (array) $this->post($url, $payload);
        $result = new ChatMember($data);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id'          => Validator::CHECK_REQUIRED,
            'sticker_set_name' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::SET_CHAT_STICKER_SET);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::DELETE_CHAT_STICKER_SET);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'callback_query_id' => Validator::CHECK_REQUIRED,
            'text'              => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'show_alert'        => Validator::CHECK_NO_REQUIRED,
            'url'               => Validator::CHECK_NO_REQUIRED,
            'cache_time'        => Validator::CHECK_NO_REQUIRED
        ));

        $url = $this->getUrl(self::ANSWER_CALLBACK_QUERY);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'text'                     => Validator::CHECK_REQUIRED,
            'chat_id'                  => Validator::CHECK_NO_REQUIRED,
            'message_id'               => Validator::CHECK_NO_REQUIRED,
            'inline_message_id'        => Validator::CHECK_NO_REQUIRED,
            'parse_mode'               => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_PARSE_MODE_TYPE
            ),
            'disable_web_page_preview' => Validator::CHECK_NO_REQUIRED,
            'reply_markup'             => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::EDIT_MESSAGE_TEXT);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'           => Validator::CHECK_NO_REQUIRED,
            'message_id'        => Validator::CHECK_NO_REQUIRED,
            'inline_message_id' => Validator::CHECK_NO_REQUIRED,
            'caption'           => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_CAPTION_LIMIT
            ),
            'reply_markup'      => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::EDIT_MESSAGE_CAPTION);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'           => Validator::CHECK_NO_REQUIRED,
            'message_id'        => Validator::CHECK_NO_REQUIRED,
            'inline_message_id' => Validator::CHECK_NO_REQUIRED,
            'reply_markup'      => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::EDIT_MESSAGE_REPLY_MARKUP);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'chat_id'    => Validator::CHECK_REQUIRED,
            'message_id' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::DELETE_MESSAGE);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'sticker'              => Validator::CHECK_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_STICKER);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'name' => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::GET_STICKER_SET);
        $data = (array) $this->post($url, $payload);
        $result = new StickerSet($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @pai
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     * @param array $parameters
     * @return File
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function uploadStickerFile(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'chat_id'     => Validator::CHECK_REQUIRED,
            'png_sticker' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::UPLOAD_STICKER_FILE);
        $data = (array) $this->post($url, $payload);
        $result = new File($data);

        unset($parameters, $url, $payload, $data);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#createnewstickerset
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function createNewStickerSet(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'user_id'       => Validator::CHECK_REQUIRED,
            'name'          => Validator::CHECK_REQUIRED,
            'title'         => Validator::CHECK_REQUIRED,
            'png_sticker'   => Validator::CHECK_REQUIRED,
            'emojis'        => Validator::CHECK_REQUIRED,
            'is_masks'      => Validator::CHECK_NO_REQUIRED,
            'mask_position' => Validator::CHECK_NO_REQUIRED,

        ));

        $url = $this->getUrl(self::CREATE_NEW_STICKER_SET);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#addstickertoset
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function addStickerToSet(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'user_id'       => Validator::CHECK_REQUIRED,
            'name'          => Validator::CHECK_REQUIRED,
            'png_sticker'   => Validator::CHECK_REQUIRED,
            'emojis'        => Validator::CHECK_REQUIRED,
            'mask_position' => Validator::CHECK_NO_REQUIRED
        ));

        $url = $this->getUrl(self::ADD_STICKER_TO_SET);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setStickerPositionInSet(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'sticker'  => Validator::CHECK_REQUIRED,
            'position' => Validator::CHECK_REQUIRED
        ));

        $url = $this->getUrl(self::SET_STICKER_POSITION_IN_SET);
        $result = (bool) $this->post($url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteStickerFromSet(array $parameters) {

        $payload = $this->getParameters($parameters, array(
            'sticker' => Validator::CHECK_REQUIRED,
        ));

        $url = $this->getUrl(self::DELETE_STICKER_FROM_SET);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'inline_query_id'     => Validator::CHECK_REQUIRED,
            'results'             => Validator::CHECK_REQUIRED,
            'cache_time'          => Validator::CHECK_NO_REQUIRED,
            'is_personal'         => Validator::CHECK_NO_REQUIRED,
            'next_offset'         => Validator::CHECK_NO_REQUIRED,
            'switch_pm_text'      => Validator::CHECK_NO_REQUIRED,
            'switch_pm_parameter' => Validator::CHECK_NO_REQUIRED
        ));

        if (count($payload['results']) > 50) {
            throw new TelegramBotAPIException('No more than 50 results per query are allowed');
        }

        $payload['results'] = json_encode($payload['results']);

        if (isset($payload['switch_pm_parameter'])) {
            if (!preg_match(Validator::SWITCH_PM_PARAM_PATTERN, $payload['switch_pm_parameter'])) {
                throw new TelegramBotAPIException('Switch pm parameter only A-Z, a-z, 0-9, _ and - are allowed.');
            }
        }

        $url = $this->getUrl(self::ANSWER_INLINE_QUERY);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id'               => Validator::CHECK_REQUIRED,
            'title'                 => Validator::CHECK_REQUIRED,
            'description'           => Validator::CHECK_REQUIRED,
            'payload'               => Validator::CHECK_REQUIRED,
            'provider_token'        => Validator::CHECK_REQUIRED,
            'start_parameter'       => Validator::CHECK_REQUIRED,
            'currency'              => Validator::CHECK_REQUIRED,
            'prices'                => Validator::CHECK_REQUIRED,
            'photo_url'             => Validator::CHECK_NO_REQUIRED,
            'photo_size'            => Validator::CHECK_NO_REQUIRED,
            'photo_width'           => Validator::CHECK_NO_REQUIRED,
            'photo_height'          => Validator::CHECK_NO_REQUIRED,
            'need_name'             => Validator::CHECK_NO_REQUIRED,
            'need_phone_number'     => Validator::CHECK_NO_REQUIRED,
            'need_email'            => Validator::CHECK_NO_REQUIRED,
            'need_shipping_address' => Validator::CHECK_NO_REQUIRED,
            'is_flexible'           => Validator::CHECK_NO_REQUIRED,
            'disable_notification'  => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'   => Validator::CHECK_NO_REQUIRED,
            'reply_markup'          => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $payload['prices'] = json_encode($payload['prices']);

        $url = $this->getUrl(self::SEND_INVOICE);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'shipping_query_id' => Validator::CHECK_REQUIRED,
            'ok'                => Validator::CHECK_REQUIRED,
            'shipping_options'  => Validator::CHECK_NO_REQUIRED,
            'error_message'     => Validator::CHECK_NO_REQUIRED
        ));

        $url = $this->getUrl(self::ANSWER_SHIPPING_QUERY);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'pre_checkout_query_id' => Validator::CHECK_REQUIRED,
            'ok'                    => Validator::CHECK_REQUIRED,
            'error_message'         => Validator::CHECK_NO_REQUIRED
        ));

        $url = $this->getUrl(self::ANSWER_SHIPPING_QUERY);
        $result = (bool) $this->post($url, $payload);

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

        $payload = $this->getParameters($parameters, array(
            'chat_id'              => Validator::CHECK_REQUIRED,
            'game_short_name'      => Validator::CHECK_REQUIRED,
            'disable_notification' => Validator::CHECK_NO_REQUIRED,
            'reply_to_message_id'  => Validator::CHECK_NO_REQUIRED,
            'reply_markup'         => array(
                'required' => Validator::CHECK_NO_REQUIRED,
                'type'     => Validator::CHECK_KEYBOARD_TYPE
            )
        ));

        $url = $this->getUrl(self::SEND_GAME);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'user_id'              => Validator::CHECK_REQUIRED,
            'score'                => Validator::CHECK_REQUIRED,
            'force'                => Validator::CHECK_NO_REQUIRED,
            'disable_edit_message' => Validator::CHECK_NO_REQUIRED,
            'chat_id'              => Validator::CHECK_NO_REQUIRED,
            'message_id'           => Validator::CHECK_NO_REQUIRED,
            'inline_message_id'    => Validator::CHECK_NO_REQUIRED
        ));

        $url = $this->getUrl(self::SET_GAME_SCORE);
        $data = (array) $this->post($url, $payload);
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

        $payload = $this->getParameters($parameters, array(
            'user_id'           => Validator::CHECK_REQUIRED,
            'chat_id'           => Validator::CHECK_NO_REQUIRED,
            'message_id'        => Validator::CHECK_NO_REQUIRED,
            'inline_message_id' => Validator::CHECK_NO_REQUIRED,
        ));

        $url = $this->getUrl(self::GET_GAME_HIGH_SCORES);
        $data = (array) $this->post($url, $payload);
        $result = array();

        foreach ($data as $obj) {
            $result[] = new GameHighScore($obj);
        }

        unset($parameters, $url, $payload, $data);

        return $result;
    }


    /**
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
     * @param string|null $token
     *
     * @throws TelegramBotAPIException
     */
    public function __construct($token = null) {

        if (isset($token)) {
            $this->setToken($token);
        }
    }
}
