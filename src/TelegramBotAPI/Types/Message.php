<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#message
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Message implements JsonDeserializerInterface {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setMessageId($data['message_id']);

        if (isset($data['from'])) $this->setFrom(new User($data['from']));

        $this->setDate($data['date']);
        $this->setChat(new Chat($data['chat']));

        if (isset($data['forward_from'])) $this->setForwardFrom(new User($data['forward_from']));
        if (isset($data['forward_from_chat'])) $this->setForwardFromChat(new Chat($data['forward_from_chat']));
        if (isset($data['forward_from_message_id'])) $this->setForwardFromMessageId($data['forward_from_message_id']);
        if (isset($data['forward_date'])) $this->setForwardDate($data['forward_date']);
        if (isset($data['reply_to_message'])) $this->setReplyToMessage(new Message($data['reply_to_message']));
        if (isset($data['edit_date'])) $this->setEditDate($data['edit_date']);
        if (isset($data['text'])) $this->setText($data['text']);

        if (isset($data['entities'])) {

            $entities = array();

            foreach ($data['entities'] as $entity) $entities[] = new MessageEntity($entity);

            $this->setEntities($entities);
        }

        if (isset($data['audio'])) $this->setAudio(new Audio($data['audio']));
        if (isset($data['document'])) $this->setDocument(new Document($data['document']));
        if (isset($data['game'])) $this->setGame(new Game($data['game']));

        if (isset($data['photo'])) {

            $photos = array();

            foreach ($data['photo'] as $photo) $photos[] = new PhotoSize($photo);

            $this->setPhoto($photos);
        }

        if (isset($data['sticker'])) $this->setSticker(new Sticker($data['sticker']));
        if (isset($data['video'])) $this->setVideo(new Video($data['video']));
        if (isset($data['video_note'])) $this->setVideoNote(new VideoNote($data['video_note']));

        if (isset($data['new_chat_members'])) {

            $users = array();

            foreach ($data['new_chat_members'] as $user) $users[] = new User($user);

            $this->setNewChatPhoto($users);
        }

        if (isset($data['voice'])) $this->setVoice(new Voice($data['voice']));
        if (isset($data['caption'])) $this->setCaption($data['caption']);
        if (isset($data['contact'])) $this->setContact(new Contact($data['contact']));
        if (isset($data['location'])) $this->setLocation(new Location($data['location']));
        if (isset($data['venue'])) $this->setVenue(new Venue($data['venue']));
        if (isset($data['new_chat_member'])) $this->setNewChatMember(new User($data['new_chat_member']));
        if (isset($data['left_chat_member'])) $this->setLeftChatMember(new User($data['left_chat_member']));
        if (isset($data['new_chat_title'])) $this->setNewChatTitle($data['new_chat_title']);

        if (isset($data['new_chat_photo'])) {

            $photos = array();

            foreach ($data['new_chat_photo'] as $photo) $photos[] = new PhotoSize($photo);

            $this->setNewChatPhoto($photos);
        }

        if (isset($data['delete_chat_photo'])) $this->setDeleteChatPhoto($data['delete_chat_photo']);
        if (isset($data['group_chat_created'])) $this->setGroupChatCreated($data['group_chat_created']);
        if (isset($data['supergroup_chat_created'])) $this->setSupergroupChatCreated($data['supergroup_chat_created']);
        if (isset($data['migrate_to_chat_id'])) $this->setChannelChatCreated($data['channel_chat_created']);
        if (isset($data['migrate_to_chat_id'])) $this->setMigrateToChatId($data['migrate_to_chat_id']);
        if (isset($data['migrate_from_chat_id'])) $this->setMigrateFromChatId($data['migrate_from_chat_id']);
        if (isset($data['pinned_message'])) $this->setPinnedMessage(new Message($data['pinned_message']));

        if (isset($data['invoice'])) $this->setInvoice(new Invoice($data['invoice']));
        if (isset($data['successful_payment'])) $this->setSuccessfulPayment(new SuccessfulPayment($data['successful_payment']));
    }

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
}
