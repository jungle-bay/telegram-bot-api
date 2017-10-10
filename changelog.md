# Changelog for Telegram Bot API

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
