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
     * @param string $token
     * @throws TelegramBotAPIException
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
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
            throw new TelegramBotAPIException('`token` require');
        }

        return $this->token;
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

        $payload = array();

        if (isset($parameters['offset'])) {
            $payload['offset'] = (int) $parameters['offset'];
        }

        if (isset($parameters['limit'])) {

            $limit = (int) $parameters['limit'];

            if (!$this->checkLimit($limit)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit limits the number of updates that are updated.
                    Values from 1 to 100 are accepted. Default is 100.
                ');
            } else {
                $payload['limit'] = $limit;
            }
        }

        if (isset($parameters['timeout'])) {
            $payload['timeout'] = (int) $parameters['timeout'];
        }

        if (isset($parameters['allowed_updates'])) {
            $payload['allowed_updates'] = (array) $parameters['allowed_updates'];
        }

        $url = $this->generateUrl(TBAPrivateConst::GET_UPDATES);
        $data = parent::post($url, $payload);
        $result = array();

        foreach ($data as $obj) $result[] = new Update($obj);

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

        if (empty($parameters['url'])) {
            throw new TelegramBotAPIException('`url` is required.');
        }

        $payload = array();

        $payload['url'] = (string) $parameters['url'];

        if (isset($parameters['certificate'])) {

            $certificate = $parameters['certificate'];

            if (!$certificate instanceof InputFile) {
                new TelegramBotAPIWarning('
                    Used not by the correct object certificate.
                    Must be InputFile.
                    More: https://core.telegram.org/bots/api#inputfile
                ');
            } else {
                $payload['certificate'] = $certificate;
            }
        }

        if (isset($parameters['max_connections'])) {

            $maxConnections = (int) $parameters['max_connections'];

            if (!$this->checkLimit($maxConnections)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100.
                    Defaults to 40. Use lower values to limit the load on your bot‘s server,
                    and higher values to increase your bot’s throughput.
                ');
            } else {
                $payload['max_connections'] = $maxConnections;
            }
        }

        if (isset($parameters['allowed_updates'])) {
            $payload['allowed_updates'] = (array) $parameters['allowed_updates'];
        }

        $url = $this->generateUrl(TBAPrivateConst::SET_WEBHOOK);
        $result = parent::post($url, $payload);

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
        $result = parent::get($url);

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
        $data = parent::get($url);
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
        $data = parent::get($url);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['text'])) {
            throw new TelegramBotAPIException('`text` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
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

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_MESSAGE);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['from_chat_id'])) {
            throw new TelegramBotAPIException('`from_chat_id` is required.');
        }

        if (empty($parameters['message_id'])) {
            throw new TelegramBotAPIException('`message_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['from_chat_id'] = (string) $parameters['from_chat_id'];

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        $payload['message_id'] = (int) $parameters['message_id'];

        $url = $this->generateUrl(TBAPrivateConst::FORWARD_MESSAGE);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['photo'])) {
            throw new TelegramBotAPIException('`photo` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['photo'] = $parameters['photo'];

        if (isset($parameters['caption'])) {

            $caption = (string) $parameters['caption'];

            if (!$this->checkCaptionLimit($caption)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Photo caption (may also be used when resending photos by file_id),
                    0-200 characters.
                ');
            } else {
                $payload['caption'] = $caption;
            }
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_PHOTO);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['audio'])) {
            throw new TelegramBotAPIException('`audio` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['audio'] = $parameters['audio'];

        if (isset($parameters['caption'])) {

            $caption = (string) $parameters['caption'];

            if (!$this->checkCaptionLimit($caption)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Audio caption, 0-200 characters.
                ');
            } else {
                $payload['caption'] = $caption;
            }
        }

        if (isset($parameters['duration'])) {
            $payload['duration'] = (int) $parameters['duration'];
        }

        if (isset($parameters['performer'])) {
            $payload['performer'] = (string) $parameters['performer'];
        }

        if (isset($parameters['title'])) {
            $payload['title'] = (string) $parameters['title'];
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_AUDIO);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['document'])) {
            throw new TelegramBotAPIException('`document` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['document'] = $parameters['document'];

        if (isset($parameters['caption'])) {

            $caption = (string) $parameters['caption'];

            if (!$this->checkCaptionLimit($caption)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Document caption (may also be used when resending documents by file_id),
                    0-200 characters.
                ');
            } else {
                $payload['caption'] = $caption;
            }
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_DOCUMENT);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['sticker'])) {
            throw new TelegramBotAPIException('`sticker` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['sticker'] = $parameters['sticker'];

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_STICKER);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['video'])) {
            throw new TelegramBotAPIException('`video` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['video'] = $parameters['video'];

        if (isset($parameters['duration'])) {
            $payload['duration'] = (int) $parameters['duration'];
        }

        if (isset($parameters['width'])) {
            $payload['width'] = (int) $parameters['width'];
        }

        if (isset($parameters['height'])) {
            $payload['height'] = (int) $parameters['height'];
        }

        if (isset($parameters['caption'])) {

            $caption = (string) $parameters['caption'];

            if (!$this->checkCaptionLimit($caption)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Video caption (may also be used when resending videos by file_id),
                    0-200 characters.
                ');
            } else {
                $payload['caption'] = $caption;
            }
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_VIDEO);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['voice'])) {
            throw new TelegramBotAPIException('`voice` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['voice'] = $parameters['voice'];

        if (isset($parameters['caption'])) {

            $caption = (string) $parameters['caption'];

            if (!$this->checkCaptionLimit($caption)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Voice message caption,
                    0-200 characters.
                ');
            } else {
                $payload['caption'] = $caption;
            }
        }

        if (isset($parameters['duration'])) {
            $payload['duration'] = (int) $parameters['duration'];
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_VOICE);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['video_note'])) {
            throw new TelegramBotAPIException('`video_note` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['video_note'] = $parameters['video_note'];

        if (isset($parameters['duration'])) {
            $payload['duration'] = (int) $parameters['duration'];
        }

        if (isset($parameters['length'])) {
            $payload['length'] = (int) $parameters['length'];
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_VIDEO_NOTE);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['latitude'])) {
            throw new TelegramBotAPIException('`latitude` is required.');
        }

        if (empty($parameters['longitude'])) {
            throw new TelegramBotAPIException('`longitude` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['latitude'] = (float) $parameters['latitude'];
        $payload['longitude'] = (float) $parameters['longitude'];

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_LOCATION);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['latitude'])) {
            throw new TelegramBotAPIException('`latitude` is required.');
        }

        if (empty($parameters['longitude'])) {
            throw new TelegramBotAPIException('`longitude` is required.');
        }

        if (empty($parameters['title'])) {
            throw new TelegramBotAPIException('`title` is required.');
        }

        if (empty($parameters['address'])) {
            throw new TelegramBotAPIException('`address` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['latitude'] = (float) $parameters['latitude'];
        $payload['longitude'] = (float) $parameters['longitude'];
        $payload['title'] = (string) $parameters['title'];
        $payload['address'] = (string) $parameters['address'];

        if (isset($parameters['foursquare_id'])) {
            $payload['foursquare_id'] = (string) $parameters['foursquare_id'];
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_VENUE);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['phone_number'])) {
            throw new TelegramBotAPIException('`phone_number` is required.');
        }

        if (empty($parameters['first_name'])) {
            throw new TelegramBotAPIException('`first_name` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['phone_number'] = (string) $parameters['phone_number'];
        $payload['first_name'] = (string) $parameters['first_name'];

        if (isset($parameters['last_name'])) {
            $payload['last_name'] = (string) $parameters['last_name'];
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = (bool) $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = (int) $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_CONTACT);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['action'])) {
            throw new TelegramBotAPIException('`action` is required.');
        }

        $action = (string) $parameters['action'];

        if (!$this->checkActionType($action)) {
            throw new TelegramBotAPIException('Type of action to broadcast.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['action'] = $action;

        $url = $this->generateUrl(TBAPrivateConst::SEND_CHAT_ACTION);
        $result = parent::post($url, $payload);

        unset($parameters, $action, $url, $data);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['title'])) {
            throw new TelegramBotAPIException('`title` is required.');
        }

        if (empty($parameters['description'])) {
            throw new TelegramBotAPIException('`description` is required.');
        }

        if (empty($parameters['payload'])) {
            throw new TelegramBotAPIException('`payload` is required.');
        }

        if (empty($parameters['provider_token'])) {
            throw new TelegramBotAPIException('`provider_token` is required.');
        }

        if (empty($parameters['start_parameter'])) {
            throw new TelegramBotAPIException('`start_parameter` is required.');
        }

        if (empty($parameters['currency'])) {
            throw new TelegramBotAPIException('`currency` is required.');
        }

        if (empty($parameters['prices'])) {
            throw new TelegramBotAPIException('`prices` is required.');
        }

        $payload = array();

        $payload['chat_id'] = (int) $parameters['chat_id'];
        $payload['title'] = (string) $parameters['title'];
        $payload['description'] = (string) $parameters['description'];
        $payload['payload'] = (string) $parameters['payload'];
        $payload['provider_token'] = (string) $parameters['provider_token'];
        $payload['start_parameter'] = (string) $parameters['start_parameter'];
        $payload['currency'] = (string) $parameters['currency'];

        foreach ($parameters['prices'] as $price) {
            /** @var LabeledPrice $price */
            $payload['prices'] = $price;
        }

        if (isset($parameters['photo_url'])) {
            $payload['photo_url'] = $parameters['photo_url'];
        }

        if (isset($parameters['photo_size'])) {
            $payload['photo_size'] = $parameters['photo_size'];
        }

        if (isset($parameters['photo_width'])) {
            $payload['photo_width'] = $parameters['photo_width'];
        }

        if (isset($parameters['photo_height'])) {
            $payload['photo_height'] = $parameters['photo_height'];
        }

        if (isset($parameters['need_name'])) {
            $payload['need_name'] = $parameters['need_name'];
        }

        if (isset($parameters['need_phone_number'])) {
            $payload['need_phone_number'] = $parameters['need_phone_number'];
        }

        if (isset($parameters['need_email'])) {
            $payload['need_email'] = $parameters['need_email'];
        }

        if (isset($parameters['need_shipping_address'])) {
            $payload['need_shipping_address'] = $parameters['need_shipping_address'];
        }

        if (isset($parameters['is_flexible'])) {
            $payload['is_flexible'] = $parameters['is_flexible'];
        }

        if (isset($parameters['disable_notification'])) {
            $payload['disable_notification'] = $parameters['disable_notification'];
        }

        if (isset($parameters['reply_to_message_id'])) {
            $payload['reply_to_message_id'] = $parameters['reply_to_message_id'];
        }

        if (isset($parameters['reply_markup'])) {

            $replyMarkup = $parameters['reply_markup'];

            if (!$this->checkKeyboardType($replyMarkup)) {
                new TelegramBotAPIWarning('Invalid keyboard type.');
            } else {
                $payload['reply_markup'] = json_encode($replyMarkup);
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::SEND_INVOICE);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['user_id'] = (int) $parameters['user_id'];

        if (isset($parameters['offset'])) {
            $payload['offset'] = (int) $parameters['offset'];
        }

        if (isset($parameters['limit'])) {

            $limit = (int) $parameters['limit'];

            if (!$this->checkLimit($limit)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit limits the number of photos to be retrieved.
                    Values between 1—100 are accepted. Defaults to 100.
                ');
            } else {
                $payload['limit'] = $limit;
            }
        }

        $url = $this->generateUrl(TBAPrivateConst::GET_USER_PROFILE_PHOTOS);
        $data = parent::post($url, $payload);
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
            $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['user_id'] = (int) $parameters['user_id'];

        if (isset($parameters['until_date'])) {
            $payload['until_date'] = $parameters['until_date'];
        }

        $url = $this->generateUrl(TBAPrivateConst::KICK_CHAT_MEMBER);
        $result = parent::post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];

        $url = $this->generateUrl(TBAPrivateConst::LEAVE_CHAT);
        $result = parent::post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['user_id'] = (int) $parameters['user_id'];

        $url = $this->generateUrl(TBAPrivateConst::UNBAN_CHAT_MEMBER);
        $result = parent::post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT_ADMINISTRATORS);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT_MEMBERS_COUNT);
        $result = parent::post($url, $payload);

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

        if (empty($parameters['chat_id'])) {
            throw new TelegramBotAPIException('`chat_id` is required.');
        }

        if (empty($parameters['user_id'])) {
            throw new TelegramBotAPIException('`user_id` is required.');
        }

        $payload = array();

        $payload['chat_id'] = $parameters['chat_id'];
        $payload['user_id'] = (int) $parameters['user_id'];

        $url = $this->generateUrl(TBAPrivateConst::GET_CHAT_MEMBER);
        $data = parent::post($url, $payload);
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

        if (empty($parameters['callback_query_id'])) {
            throw new TelegramBotAPIException('`callback_query_id` is required.');
        }

        $payload = array();

        $payload['callback_query_id'] = (string) $parameters['callback_query_id'];

        if (isset($parameters['text'])) {

            $text = (string) $parameters['text'];

            if (!$this->checkCaptionLimit($text)) {
                new TelegramBotAPIWarning('
                    Used not by the correct limit.
                    Text of the notification. If not specified,
                    nothing will be shown to the user,
                    0-200 characters.
                ');
            } else {
                $payload['text'] = $text;
            }
        }

        if (isset($parameters['show_alert'])) {
            $payload['show_alert'] = (bool) $parameters['show_alert'];
        }

        if (isset($parameters['url'])) {
            $payload['url'] = (string) $parameters['url'];
        }

        if (isset($parameters['cache_time'])) {
            $payload['cache_time'] = (int) $parameters['cache_time'];
        }

        $url = $this->generateUrl(TBAPrivateConst::ANSWER_CALLBACK_QUERY);
        $result = parent::post($url, $payload);

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
        $data = parent::post($url, $payload);
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
        $data = parent::post($url, $payload);
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
        $data = parent::post($url, $payload);
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
        $data = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $data = parent::post($url, $payload);
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
        $data = parent::post($url, $payload);
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
        $data = parent::post($url, $payload);
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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $data = parent::post($url, $payload);
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
        $data = parent::post($url, $payload);
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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
        $result = parent::post($url, $payload);

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
