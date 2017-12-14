<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI;


use TelegramBotAPI\Core\HTTP;
use TelegramBotAPI\Types\User;
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\File;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\ChatMember;
use TelegramBotAPI\Types\StickerSet;
use TelegramBotAPI\Types\WebhookInfo;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\Types\UserProfilePhotos;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

/**
 * Class TelegramBotAPI
 * @package TelegramBotAPI
 * @link https://core.telegram.org/bots/api
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPI extends HTTP {

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setwebhook
     * @param string $request
     * @return Update
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setUpdate($request) {

        $data = $this->parserResponse($request);

        return new Update($data);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getting-updates
     * @param string $request
     * @return Update[]
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setUpdates($request) {

        $data = $this->parserResponse($request);

        $this->firewallError($data);
        $this->firewallResult($data);

        $updates = array();

        foreach ($data['result'] as $update) $updates[] = new Update($update);

        return $updates;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#getupdates
     * @param array $parameters
     * @return Update[]
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getUpdates($parameters = array()) {

        $result = $this->getResult($this->getMethod(self::GET_UPDATES), $parameters);
        $updates = array();

        foreach ($result as $update) $updates[] = new Update($update);

        return $updates;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setwebhook
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setWebhook(array $parameters) {
        return $this->getResult($this->getMethod(self::SET_WEBHOOK), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletewebhook
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteWebhook() {
        return $this->getResult($this->getMethod(self::DELETE_WEBHOOK));
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     * @return WebhookInfo
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getWebhookInfo() {

        $result = $this->getResult($this->getMethod(self::GET_WEBHOOK_INFO));

        return new WebhookInfo($result);
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#getme
     * @return User
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getMe() {

        $result = $this->getResult($this->getMethod(self::GET_ME));

        return new User($result);
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendmessage
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendMessage(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_MESSAGE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @param array $parameters
     * @link https://core.telegram.org/bots/api#forwardmessage
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function forwardMessage(array $parameters) {

        $result = $this->getResult($this->getMethod(self::FORWARD_MESSAGE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendphoto
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendPhoto(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_PHOTO), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendaudio
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendAudio(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_AUDIO), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#senddocument
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendDocument(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_DOCUMENT), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvideo
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVideo(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_VIDEO), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvoice
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVoice(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_VOICE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvideonote
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVideoNote(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_VIDEO_NOTE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendmediagroup
     * @param array $parameters
     * @return Message[]
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendMediaGroup(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_MEDIA_GROUP), $parameters);
        $messages = array();

        foreach ($result as $message) $messages[] = new Message($message);

        return $messages;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendlocation
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendLocation(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_LOCATION), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     * @param array $parameters
     * @return Message|bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageLiveLocation(array $parameters) {

        $result = $this->getResult($this->getMethod(self::EDIT_MESSAGE_LIVE_LOCATION), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     * @param array $parameters
     * @return Message|bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function stopMessageLiveLocation(array $parameters) {

        $result = $this->getResult($this->getMethod(self::STOP_MESSAGE_LIVE_LOCATION), $parameters);

        if (is_array($result)) return new Message($result);

        return true;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendvenue
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendVenue(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_VENUE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendcontact
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendContact(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_CONTACT), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendchataction
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendChatAction(array $parameters) {
        return $this->getResult($this->getMethod(self::SEND_CHAT_ACTION), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     * @param array $parameters
     * @return UserProfilePhotos
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getUserProfilePhotos(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_USER_PROFILE_PHOTOS), $parameters);

        return new UserProfilePhotos($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getfile
     * @param array $parameters
     * @return File
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getFile(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_FILE), $parameters);

        return new File($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getfile
     * @param array $parameters
     * @return bool|string
     * @throws TelegramBotAPIException
     */
    public function loadFile(array $parameters) {

        $url = sprintf(self::TELEGRAM_BOT_FILE, $this->getToken(), $parameters['file_path']);

        return file_get_contents($url);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#kickchatmember
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function kickChatMember(array $parameters) {
        return $this->getResult($this->getMethod(self::KICK_CHAT_MEMBER), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#unbanchatmember
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function unbanChatMember(array $parameters) {
        return $this->getResult($this->getMethod(self::UNBAN_CHAT_MEMBER), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#restrictchatmember
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function restrictChatMember(array $parameters) {
        return $this->getResult($this->getMethod(self::RESTRICT_CHAT_MEMBER), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function promoteChatMember(array $parameters) {
        return $this->getResult($this->getMethod(self::PROMOTE_CHAT_MEMBER), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     * @param array $parameters
     * @return string
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function exportChatInviteLink(array $parameters) {
        return $this->getResult($this->getMethod(self::EXPORT_CHAT_INVITE_LINK), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatphoto
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatPhoto(array $parameters) {
        return $this->getResult($this->getMethod(self::SET_CHAT_PHOTO), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletechatphoto
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteChatPhoto(array $parameters) {
        return $this->getResult($this->getMethod(self::DELETE_CHAT_PHOTO), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchattitle
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatTitle(array $parameters) {
        return $this->getResult($this->getMethod(self::SET_CHAT_TITLE), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatdescription
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatDescription(array $parameters) {
        return $this->getResult($this->getMethod(self::SET_CHAT_DESCRIPTION), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#pinchatmessage
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function pinChatMessage(array $parameters) {
        return $this->getResult($this->getMethod(self::PIN_CHAT_MESSAGE), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function unpinChatMessage(array $parameters) {
        return $this->getResult($this->getMethod(self::UNPIN_CHAT_MESSAGE), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#leavechat
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function leaveChat(array $parameters) {
        return $this->getResult($this->getMethod(self::LEAVE_CHAT), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchat
     * @param array $parameters
     * @return Chat
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChat(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_CHAT), $parameters);

        return new Chat($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchatadministrators
     * @param array $parameters
     * @return ChatMember[]
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChatAdministrators(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_CHAT_ADMINISTRATORS), $parameters);
        $chatMembers = array();

        foreach ($result as $chatMember) $chatMembers[] = new ChatMember($chatMember);

        return $chatMembers;
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     * @param array $parameters
     * @return int
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChatMembersCount(array $parameters) {
        return $this->getResult($this->getMethod(self::GET_CHAT_MEMBERS_COUNT), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getchatmember
     * @param array $parameters
     * @return ChatMember
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getChatMember(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_CHAT_MEMBER), $parameters);

        return new ChatMember($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setchatstickerset
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setChatStickerSet(array $parameters) {
        return $this->getResult($this->getMethod(self::SET_CHAT_STICKER_SET), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteChatStickerSet(array $parameters) {
        return $this->getResult($this->getMethod(self::DELETE_CHAT_STICKER_SET), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answercallbackquery
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerCallbackQuery(array $parameters) {
        return $this->getResult($this->getMethod(self::ANSWER_CALLBACK_QUERY), $parameters);
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagetext
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageText(array $parameters) {

        $result = $this->getResult($this->getMethod(self::EDIT_MESSAGE_TEXT), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagecaption
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageCaption(array $parameters) {

        $result = $this->getResult($this->getMethod(self::EDIT_MESSAGE_CAPTION), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function editMessageReplyMarkup(array $parameters) {

        $result = $this->getResult($this->getMethod(self::EDIT_MESSAGE_REPLY_MARKUP), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletemessage
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteMessage(array $parameters) {
        return $this->getResult($this->getMethod(self::DELETE_MESSAGE), $parameters);
    }


    /**
     * @api
     * @param array $parameters
     * @link https://core.telegram.org/bots/api#sendsticker
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendSticker(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_STICKER), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getstickerset
     * @param array $parameters
     * @return StickerSet
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getStickerSet(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_STICKER_SET), $parameters);

        return new StickerSet($result);
    }

    /**
     * @pai
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     * @param array $parameters
     * @return File
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function uploadStickerFile(array $parameters) {

        $result = $this->getResult($this->getMethod(self::UPLOAD_STICKER_FILE), $parameters);

        return new File($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#createnewstickerset
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function createNewStickerSet(array $parameters) {
        return $this->getResult($this->getMethod(self::CREATE_NEW_STICKER_SET), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#addstickertoset
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function addStickerToSet(array $parameters) {
        return $this->getResult($this->getMethod(self::ADD_STICKER_TO_SET), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setStickerPositionInSet(array $parameters) {
        return $this->getResult($this->getMethod(self::SET_STICKER_POSITION_IN_SET), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function deleteStickerFromSet(array $parameters) {
        return $this->getResult($this->getMethod(self::DELETE_STICKER_FROM_SET), $parameters);
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#answerinlinequery
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerInlineQuery(array $parameters) {
        return $this->getResult($this->getMethod(self::ANSWER_INLINE_QUERY), $parameters);
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendinvoice
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendInvoice(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_INVOICE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answershippingquery
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerShippingQuery(array $parameters) {
        return $this->getResult($this->getMethod(self::ANSWER_SHIPPING_QUERY), $parameters);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     * @param array $parameters
     * @return bool
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerPreCheckoutQuery(array $parameters) {
        return $this->getResult($this->getMethod(self::ANSWER_PRE_CHECKOUT_QUERY), $parameters);
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#sendgame
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function sendGame(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SEND_GAME), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#setgamescore
     * @param array $parameters
     * @return Message
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function setGameScore(array $parameters) {

        $result = $this->getResult($this->getMethod(self::SET_GAME_SCORE), $parameters);

        return new Message($result);
    }

    /**
     * @api
     * @link https://core.telegram.org/bots/api#getgamehighscores
     * @param array $parameters
     * @return GameHighScore[]
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function getGameHighScores(array $parameters) {

        $result = $this->getResult($this->getMethod(self::GET_GAME_HIGH_SCORES), $parameters);
        $gameHighScores = array();

        foreach ($result as $gameHighScore) $gameHighScores[] = new GameHighScore($gameHighScore);

        return $gameHighScores;
    }


    /**
     * @api
     * @link https://core.telegram.org/bots/api#authorizing-your-bot
     * @param string $token
     * @throws TelegramBotAPIException
     */
    public function __construct($token = null) {

        if (empty($token)) return;

        $this->setToken($token);
    }
}
