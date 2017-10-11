<?php

class Message {

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

        $scheme = array(
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
            ),
        );
    }


}

class Example {

    /**
     * Camelizes a given string.
     *
     * Thank you: (https://github.com/symfony/property-access/blob/master/PropertyAccessor.php#L733)
     *
     * @param string $value
     * @return string
     */
    private function camelize($value) {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $value)));
    }


    private $scheme = array(
        'user' => User::class,
        'get'  => false,
        'chat' => false
    );


    private function check() {

    }

    private function checkNo() {

    }


    public function __construct(array $data = array()) {


        foreach ($allow as $key => $value) {

            if ($value) isset($data[$key]) {

            }
        }

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
