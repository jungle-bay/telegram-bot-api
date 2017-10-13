<?php

namespace TelegramBotAPI;


/**
 * @package TelegramBotAPI
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
final class PrivateConst {

    const GET = 'GET';
    const POST = 'POST';

    const SWITCH_PM_PARAM_PATTERN = '/^[0-9a-zA-Z\-\_]+$/';

    const CHECK_TOKEN_PATTERN = '/^[0-9]{9}:[A-Za-z0-9\_\-]{35}$/';

    const CHECK_PARSE_MODE_TYPE = 'CHECK_PARSE_MODE_TYPE';
    const CHECK_KEYBOARD_TYPE = 'CHECK_KEYBOARD_TYPE';
    const CHECK_ACTION_TYPE = 'CHECK_ACTION_TYPE';
    const CHECK_LIMIT = 'CHECK_LIMIT';
    const CHECK_CAPTION_LIMIT = 'CHECK_CAPTION_LIMIT';
    const CHECK_NO_REQUIRED = 'CHECK_NO_REQUIRED';
    const CHECK_REQUIRED = 'CHECK_REQUIRED';
    const CHECK_LOCATION = 'CHECK_LOCATION';

    const TELEGRAM_BOT_API = 'https://api.telegram.org/bot%s/%s';
    const TELEGRAM_BOT_FILE = 'https://api.telegram.org/file/bot%s/%s';

    const LIMIT_MIN = 1;
    const LIMIT_MAX = 100;

    const CAPTION_MIN_SIZE = 1;
    const CAPTION_MAX_SIZE = 200;

    const CHECK_LOCATION_MIN = 60;
    const CHECK_LOCATION_MAX = 86400;

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
    const SEND_VIDEO_NOTE = 'sendVoice';
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
}
