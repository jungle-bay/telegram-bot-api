# Changelog for Telegram Bot API

#### 3.6 / 2018-02-13

* Supported [text formatting](https://core.telegram.org/bots/api#formatting-options) in media captions. Specify the desired ***parse_mode*** ([Markdown](https://core.telegram.org/bots/api#markdown-style) or [HTML](https://core.telegram.org/bots/api#html-style)) when you provide a caption.
* In supergroups, if the bot receives a message that is a reply, it will also receive the message to which that message is replying – even if the original message is inaccessible due to the bot's privacy settings. (In other words, replying to any message in a supergroup with a message that mentions the bot or features a command for it acts as forwarding the original message to the bot).
* Added the new field ***connected_website*** to [Message](https://core.telegram.org/bots/api#message). The bot will receive a message with this field in a private chat when a user logs in on the bot's connected website using the [Login Widget](https://core.telegram.org/widgets/login) and allows sending messages from your bot.
* Added the new parameter ***supports_streaming*** to the [sendVideo](https://core.telegram.org/bots/api#sendvideo) method and a field with the same name to the [inputMediaVideo](https://core.telegram.org/bots/api#inputmediavideo) object.

#### 3.5.3 / 2017-12-14

* Added two methods **getResponseParameters** and **setResponseParameters** to `TelegramBotAPIRuntimeException`.
* Methods have been replaced boolean type `get*` to `is*`.

#### 3.5 / 2017-11-17

* Added the new method [sendMediaGroup](https://core.telegram.org/bots/api#sendmediagroup) and two kinds of [InputMedia](https://core.telegram.org/bots/api#inputmedia) objects to support the new [albums feature](https://telegram.org/blog/albums-saved-messages).
* Added support for pinning messages in channels. [pinChatMessage](https://core.telegram.org/bots/api#pinchatmessage) and [unpinChatMessage](https://core.telegram.org/bots/api#unpinchatmessage) accept channels.
* Added the new field ***provider_data*** to [sendInvoice](https://core.telegram.org/bots/api#sendinvoice) for sharing information about the invoice with the payment provider.
* Added two methods **setUpdate** and **getUpdate** to `TelegramBotAPIException`.

#### 3.4 / 2017-10-11

* Bots can now send and receive [Live Locations](https://telegram.org/blog/live-locations). Added new field ***live_period*** to the [sendLocation](https://core.telegram.org/bots/api#sendlocation) method and the [editMessageLiveLocation](https://core.telegram.org/bots/api#editmessagelivelocation) and [stopMessageLiveLocation](https://core.telegram.org/bots/api#stopmessagelivelocation) methods as well as the necessary objects for inline bots.
* Bots can use the new [setChatStickerSet](https://core.telegram.org/bots/api#setchatstickerset) and [deleteChatStickerSet](https://core.telegram.org/bots/api#deletechatstickerset) methods to manage group sticker sets.
* The [getChat](https://core.telegram.org/bots/api#getchat) request now returns the group's sticker set for supergroups if available.
* Bots now receive entities from media captions in the new field ***caption_entities*** in [Message](https://core.telegram.org/bots/api#message).

#### 3.3 / 2017-08-23

* Bots can now mention users via [inline mentions](https://core.telegram.org/bots/api#formatting-options), without using usernames.
* [getChat](https://core.telegram.org/bots/api#getchat) now also returns pinned messages in supergroups, if present. Added the new field ***pinned_message*** to the [Chat](https://core.telegram.org/bots/api#chat) object.
* Added the new fields ***author_signature*** and ***forward_signature*** to the [Message](https://core.telegram.org/bots/api#message) object.
* Added the new field ***is_bot*** to the [User](https://core.telegram.org/bots/api#user) object.

#### 3.2 / 2017-07-21

* Added new methods for working with stickers: [getStickerSet](https://core.telegram.org/bots/api#getstickerset), [uploadStickerFile](https://core.telegram.org/bots/api#uploadstickerfile), [createNewStickerSet](https://core.telegram.org/bots/api#createnewstickerset), [addStickerToSet](https://core.telegram.org/bots/api#addstickertoset), [setStickerPositionInSet](https://core.telegram.org/bots/api#setstickerpositioninset), and [deleteStickerFromSet](https://core.telegram.org/bots/api#deletestickerfromset).
* Added the fields ***set_name*** and ***mask_position*** to the [Sticker](https://core.telegram.org/bots/api#sticker) object, plus two new objects, [StickerSet](https://core.telegram.org/bots/api#stickerset), and [MaskPosition](https://core.telegram.org/bots/api#maskposition).

#### 3.1 / 2017-06-30

* Added new methods [restrictChatMember](https://core.telegram.org/bots/api#restrictchatmember) and [promoteChatMember](https://core.telegram.org/bots/api#promotechatmember) to manage users and admins, added new parameter until_date to [kickChatMember](https://core.telegram.org/bots/api#kickchatmember) for temporary bans.
* Added new methods [exportChatInviteLink](https://core.telegram.org/bots/api#exportchatinvitelink), [setChatPhoto](https://core.telegram.org/bots/api#setchatphoto), [deleteChatPhoto](https://core.telegram.org/bots/api#deletechatphoto), [setChatTitle](https://core.telegram.org/bots/api#setchattitle), [setChatDescription](https://core.telegram.org/bots/api#setchatdescription), [pinChatMessage](https://core.telegram.org/bots/api#pinchatmessage) and [unpinChatMessage](https://core.telegram.org/bots/api#unpinchatmessage) to manage groups and channels.
* Added the new fields ***photo***, ***description*** and ***invite_link*** to the [Chat]() object.
* Added the new fields ***until_date***, ***can_be_edited***, ***can_change_info***, ***can_post_messages***, ***can_edit_messages***, ***can_delete_messages***, ***can_invite_users***, ***can_restrict_members***, ***can_pin_messages***, ***can_promote_members***, ***can_send_messages***, ***can_send_media_messages***, ***can_send_other_messages*** and ***can_add_web_page_previews*** to the [ChatMember]() object.

#### 3.0 / 2017-05-18

* Initial Release.
