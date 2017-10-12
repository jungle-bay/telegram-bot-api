<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#message
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Message extends Type {

    /**
     * @var int $messageId
     */
    private $messageId;

    /**
     * @var null|User $from
     */
    private $from;

    /**
     * @var int $date
     */
    private $date;

    /**
     * @var Chat $chat
     */
    private $chat;

    /**
     * @var null|User $forwardFrom
     */
    private $forwardFrom;

    /**
     * @var null|Chat $forwardFromChat
     */
    private $forwardFromChat;

    /**
     * @var null|int $forwardFromMessageId
     */
    private $forwardFromMessageId;

    /**
     * @var null|int $forwardDate
     */
    private $forwardDate;

    /**
     * @var null|Message $replyToMessage
     */
    private $replyToMessage;

    /**
     * @var null|int $editDate
     */
    private $editDate;

    /**
     * @var null|string $text
     */
    private $text;

    /**
     * @var null|Message[] $entities
     */
    private $entities;

    /**
     * @var null|Audio $audio
     */
    private $audio;

    /**
     * @var null|Document $document
     */
    private $document;

    /**
     * @var null|Game $game
     */
    private $game;

    /**
     * @var null|PhotoSize[] $photo
     */
    private $photo;

    /**
     * @var null|Sticker $sticker
     */
    private $sticker;

    /**
     * @var null|Video $video
     */
    private $video;

    /**
     * @var null|Voice $voice
     */
    private $voice;

    /**
     * @var null|VideoNote $videoNote
     */
    private $videoNote;

    /**
     * @var null|User[] $newChatMembers
     */
    private $newChatMembers;

    /**
     * @var null|string $caption
     */
    private $caption;

    /**
     * @var null|Contact $contact
     */
    private $contact;

    /**
     * @var null|Location $location
     */
    private $location;

    /**
     * @var null|Venue $venue
     */
    private $venue;

    /**
     * @var null|User $newChatMember
     */
    private $newChatMember;

    /**
     * @var null|User $leftChatMember
     */
    private $leftChatMember;

    /**
     * @var null|string $newChatTitle
     */
    private $newChatTitle;

    /**
     * @var null|PhotoSize[] $newChatPhoto
     */
    private $newChatPhoto;

    /**
     * @var null|bool $deleteChatPhoto
     */
    private $deleteChatPhoto;

    /**
     * @var null|bool $groupChatCreated
     */
    private $groupChatCreated;

    /**
     * @var null|bool $supergroupChatCreated
     */
    private $supergroupChatCreated;

    /**
     * @var null|bool $channelChatCreated
     */
    private $channelChatCreated;

    /**
     * @var null|int $migrateToChatId
     */
    private $migrateToChatId;

    /**
     * @var null|int $migrateFromChatId
     */
    private $migrateFromChatId;

    /**
     * @var null|Message $pinnedMessage
     */
    private $pinnedMessage;

    /**
     * @var null|Invoice $invoice
     */
    private $invoice;

    /**
     * @var null|SuccessfulPayment $successfulPayment
     */
    private $successfulPayment;

    /**
     * @var null|string $authorSignature
     */
    private $authorSignature;

    /**
     * @var null|string $forwardSignature
     */
    private $forwardSignature;


    /**
     * @return int
     */
    public function getMessageId() {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     */
    public function setMessageId($messageId) {
        $this->messageId = $messageId;
    }

    /**
     * @return null|User
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @param null|User $from
     */
    public function setFrom($from) {
        $this->from = $from;
    }

    /**
     * @return int
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return Chat
     */
    public function getChat() {
        return $this->chat;
    }

    /**
     * @param Chat $chat
     */
    public function setChat($chat) {
        $this->chat = $chat;
    }

    /**
     * @return null|User
     */
    public function getForwardFrom() {
        return $this->forwardFrom;
    }

    /**
     * @param null|User $forwardFrom
     */
    public function setForwardFrom($forwardFrom) {
        $this->forwardFrom = $forwardFrom;
    }

    /**
     * @return null|Chat
     */
    public function getForwardFromChat() {
        return $this->forwardFromChat;
    }

    /**
     * @param null|Chat $forwardFromChat
     */
    public function setForwardFromChat($forwardFromChat) {
        $this->forwardFromChat = $forwardFromChat;
    }

    /**
     * @return int|null
     */
    public function getForwardFromMessageId() {
        return $this->forwardFromMessageId;
    }

    /**
     * @param int|null $forwardFromMessageId
     */
    public function setForwardFromMessageId($forwardFromMessageId) {
        $this->forwardFromMessageId = $forwardFromMessageId;
    }

    /**
     * @return int|null
     */
    public function getForwardDate() {
        return $this->forwardDate;
    }

    /**
     * @param int|null $forwardDate
     */
    public function setForwardDate($forwardDate) {
        $this->forwardDate = $forwardDate;
    }

    /**
     * @return null|Message
     */
    public function getReplyToMessage() {
        return $this->replyToMessage;
    }

    /**
     * @param null|Message $replyToMessage
     */
    public function setReplyToMessage($replyToMessage) {
        $this->replyToMessage = $replyToMessage;
    }

    /**
     * @return int|null
     */
    public function getEditDate() {
        return $this->editDate;
    }

    /**
     * @param int|null $editDate
     */
    public function setEditDate($editDate) {
        $this->editDate = $editDate;
    }

    /**
     * @return null|string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param null|string $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return null|Message[]
     */
    public function getEntities() {
        return $this->entities;
    }

    /**
     * @param null|Message[] $entities
     */
    public function setEntities($entities) {
        $this->entities = $entities;
    }

    /**
     * @return null|Audio
     */
    public function getAudio() {
        return $this->audio;
    }

    /**
     * @param null|Audio $audio
     */
    public function setAudio($audio) {
        $this->audio = $audio;
    }

    /**
     * @return null|Document
     */
    public function getDocument() {
        return $this->document;
    }

    /**
     * @param null|Document $document
     */
    public function setDocument($document) {
        $this->document = $document;
    }

    /**
     * @return null|Game
     */
    public function getGame() {
        return $this->game;
    }

    /**
     * @param null|Game $game
     */
    public function setGame($game) {
        $this->game = $game;
    }

    /**
     * @return null|PhotoSize[]
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * @param null|PhotoSize[] $photo
     */
    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    /**
     * @return null|Sticker
     */
    public function getSticker() {
        return $this->sticker;
    }

    /**
     * @param null|Sticker $sticker
     */
    public function setSticker($sticker) {
        $this->sticker = $sticker;
    }

    /**
     * @return null|Video
     */
    public function getVideo() {
        return $this->video;
    }

    /**
     * @param null|Video $video
     */
    public function setVideo($video) {
        $this->video = $video;
    }

    /**
     * @return null|VideoNote
     */
    public function getVideoNote() {
        return $this->videoNote;
    }

    /**
     * @param null|VideoNote $videoNote
     */
    public function setVideoNote($videoNote) {
        $this->videoNote = $videoNote;
    }

    /**
     * @return null|User[]
     */
    public function getNewChatMembers() {
        return $this->newChatMembers;
    }

    /**
     * @param null|User[] $newChatMembers
     */
    public function setNewChatMembers($newChatMembers) {
        $this->newChatMembers = $newChatMembers;
    }

    /**
     * @return null|Voice
     */
    public function getVoice() {
        return $this->voice;
    }

    /**
     * @param null|Voice $voice
     */
    public function setVoice($voice) {
        $this->voice = $voice;
    }

    /**
     * @return null|string
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     * @param null|string $caption
     */
    public function setCaption($caption) {
        $this->caption = $caption;
    }

    /**
     * @return null|Contact
     */
    public function getContact() {
        return $this->contact;
    }

    /**
     * @param null|Contact $contact
     */
    public function setContact($contact) {
        $this->contact = $contact;
    }

    /**
     * @return null|Location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param null|Location $location
     */
    public function setLocation($location) {
        $this->location = $location;
    }

    /**
     * @return null|Venue
     */
    public function getVenue() {
        return $this->venue;
    }

    /**
     * @param null|Venue $venue
     */
    public function setVenue($venue) {
        $this->venue = $venue;
    }

    /**
     * @return null|User
     */
    public function getNewChatMember() {
        return $this->newChatMember;
    }

    /**
     * @param null|User $newChatMember
     */
    public function setNewChatMember($newChatMember) {
        $this->newChatMember = $newChatMember;
    }

    /**
     * @return null|User
     */
    public function getLeftChatMember() {
        return $this->leftChatMember;
    }

    /**
     * @param null|User $leftChatMember
     */
    public function setLeftChatMember($leftChatMember) {
        $this->leftChatMember = $leftChatMember;
    }

    /**
     * @return null|string
     */
    public function getNewChatTitle() {
        return $this->newChatTitle;
    }

    /**
     * @param null|string $newChatTitle
     */
    public function setNewChatTitle($newChatTitle) {
        $this->newChatTitle = $newChatTitle;
    }

    /**
     * @return null|PhotoSize[]
     */
    public function getNewChatPhoto() {
        return $this->newChatPhoto;
    }

    /**
     * @param null|PhotoSize[] $newChatPhoto
     */
    public function setNewChatPhoto($newChatPhoto) {
        $this->newChatPhoto = $newChatPhoto;
    }

    /**
     * @return bool|null
     */
    public function getDeleteChatPhoto() {
        return $this->deleteChatPhoto;
    }

    /**
     * @param bool|null $deleteChatPhoto
     */
    public function setDeleteChatPhoto($deleteChatPhoto) {
        $this->deleteChatPhoto = $deleteChatPhoto;
    }

    /**
     * @return bool|null
     */
    public function getGroupChatCreated() {
        return $this->groupChatCreated;
    }

    /**
     * @param bool|null $groupChatCreated
     */
    public function setGroupChatCreated($groupChatCreated) {
        $this->groupChatCreated = $groupChatCreated;
    }

    /**
     * @return bool|null
     */
    public function getSupergroupChatCreated() {
        return $this->supergroupChatCreated;
    }

    /**
     * @param bool|null $supergroupChatCreated
     */
    public function setSupergroupChatCreated($supergroupChatCreated) {
        $this->supergroupChatCreated = $supergroupChatCreated;
    }

    /**
     * @return bool|null
     */
    public function getChannelChatCreated() {
        return $this->channelChatCreated;
    }

    /**
     * @param bool|null $channelChatCreated
     */
    public function setChannelChatCreated($channelChatCreated) {
        $this->channelChatCreated = $channelChatCreated;
    }

    /**
     * @return int|null
     */
    public function getMigrateToChatId() {
        return $this->migrateToChatId;
    }

    /**
     * @param int|null $migrateToChatId
     */
    public function setMigrateToChatId($migrateToChatId) {
        $this->migrateToChatId = $migrateToChatId;
    }

    /**
     * @return int|null
     */
    public function getMigrateFromChatId() {
        return $this->migrateFromChatId;
    }

    /**
     * @param int|null $migrateFromChatId
     */
    public function setMigrateFromChatId($migrateFromChatId) {
        $this->migrateFromChatId = $migrateFromChatId;
    }

    /**
     * @return null|Message
     */
    public function getPinnedMessage() {
        return $this->pinnedMessage;
    }

    /**
     * @param null|Message $pinnedMessage
     */
    public function setPinnedMessage($pinnedMessage) {
        $this->pinnedMessage = $pinnedMessage;
    }

    /**
     * @return null|Invoice
     */
    public function getInvoice() {
        return $this->invoice;
    }

    /**
     * @param null|Invoice $invoice
     */
    public function setInvoice($invoice) {
        $this->invoice = $invoice;
    }

    /**
     * @return null|SuccessfulPayment
     */
    public function getSuccessfulPayment() {
        return $this->successfulPayment;
    }

    /**
     * @param null|SuccessfulPayment $successfulPayment
     */
    public function setSuccessfulPayment($successfulPayment) {
        $this->successfulPayment = $successfulPayment;
    }

    /**
     * @return null|string
     */
    public function getAuthorSignature() {
        return $this->authorSignature;
    }

    /**
     * @param null|string $authorSignature
     */
    public function setAuthorSignature($authorSignature) {
        $this->authorSignature = $authorSignature;
    }

    /**
     * @return null|string
     */
    public function getForwardSignature() {
        return $this->forwardSignature;
    }

    /**
     * @param null|string $forwardSignature
     */
    public function setForwardSignature($forwardSignature) {
        $this->forwardSignature = $forwardSignature;
    }


    /**
     * @return array
     */
    public function getSchemaValid() {
        return array(
            'message_id'              => true,
            'from'                    => array(
                'value'   => User::class,
                'require' => false
            ),
            'date'                    => true,
            'chat'                    => array(
                'value'   => Chat::class,
                'require' => true
            ),
            'forward_from'            => array(
                'value'   => User::class,
                'require' => false
            ),
            'forward_from_chat'       => array(
                'value'   => Chat::class,
                'require' => false
            ),
            'forward_from_message_id' => false,
            'forward_date'            => false,
            'reply_to_message'        => array(
                'value'   => Message::class,
                'require' => false
            ),
            'edit_date'               => false,
            'text'                    => false,
            'entities'                => array(
                'value'   => MessageEntity::class,
                'require' => false,
                'array'   => true
            ),
            'audio'                   => array(
                'value'   => Audio::class,
                'require' => false
            ),
            'document'                => array(
                'value'   => Document::class,
                'require' => false
            ),
            'game'                    => array(
                'value'   => Game::class,
                'require' => false
            ),
            'photo'                   => array(
                'value'   => PhotoSize::class,
                'require' => false,
                'array'   => true
            ),
            'sticker'                 => array(
                'value'   => Sticker::class,
                'require' => false
            ),
            'video'                   => array(
                'value'   => Video::class,
                'require' => false
            ),
            'video_note'              => array(
                'value'   => VideoNote::class,
                'require' => false
            ),
            'new_chat_members'        => array(
                'value'   => User::class,
                'require' => false,
                'array'   => true
            ),
            'voice'                   => array(
                'value'   => Voice::class,
                'require' => false
            ),
            'caption'                 => false,
            'contact'                 => array(
                'value'   => Contact::class,
                'require' => false
            ),
            'location'                => array(
                'value'   => Location::class,
                'require' => false
            ),
            'venue'                   => array(
                'value'   => Venue::class,
                'require' => false
            ),
            'new_chat_member'         => array(
                'value'   => User::class,
                'require' => false
            ),
            'left_chat_member'        => array(
                'value'   => User::class,
                'require' => false
            ),
            'new_chat_title'          => false,
            'new_chat_photo'          => array(
                'value'   => PhotoSize::class,
                'require' => false,
                'array'   => true
            ),
            'delete_chat_photo'       => false,
            'group_chat_created'      => false,
            'supergroup_chat_created' => false,
            'channel_chat_created'    => false,
            'migrate_to_chat_id'      => false,
            'migrate_from_chat_id'    => false,
            'pinned_message'          => array(
                'value'   => Message::class,
                'require' => false,
            ),
            'invoice'                 => array(
                'value'   => Invoice::class,
                'require' => false,
            ),
            'successful_payment'      => array(
                'value'   => SuccessfulPayment::class,
                'require' => false,
            )
        );
    }
}
