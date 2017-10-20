<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#chat
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Chat extends Type {

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var null|string $title
     */
    private $title;

    /**
     * @var null|string $username
     */
    private $username;

    /**
     * @var null|string $firstName
     */
    private $firstName;

    /**
     * @var null|string $lastName
     */
    private $lastName;

    /**
     * @var null|bool $allMembersAreAdministrators
     */
    private $allMembersAreAdministrators;

    /**
     * @var null|ChatPhoto $photo
     */
    private $photo;

    /**
     * @var null|string $description
     */
    private $description;

    /**
     * @var null|string $inviteLink
     */
    private $inviteLink;

    /**
     * @var null|Message $pinnedMessage
     */
    private $pinnedMessage;

    /**
     * @var null|string $stickerSetName
     */
    private $stickerSetName;

    /**
     * @var null|bool $canSetStickerSet
     */
    private $canSetStickerSet;


    /**
     * @api
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @api
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @api
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @api
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @api
     * @return null|string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @api
     * @param null|string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @api
     * @return null|string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @api
     * @param null|string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @api
     * @return null|string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @api
     * @param null|string $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @api
     * @return null|string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @api
     * @param null|string $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getAllMembersAreAdministrators() {
        return $this->allMembersAreAdministrators;
    }

    /**
     * @api
     * @param bool|null $allMembersAreAdministrators
     */
    public function setAllMembersAreAdministrators($allMembersAreAdministrators) {
        $this->allMembersAreAdministrators = $allMembersAreAdministrators;
    }

    /**
     * @api
     * @return null|ChatPhoto
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * @api
     * @param null|ChatPhoto $photo
     */
    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    /**
     * @api
     * @return null|string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @api
     * @param null|string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @api
     * @return null|string
     */
    public function getInviteLink() {
        return $this->inviteLink;
    }

    /**
     * @api
     * @param null|string $inviteLink
     */
    public function setInviteLink($inviteLink) {
        $this->inviteLink = $inviteLink;
    }

    /**
     * @api
     * @return null|Message
     */
    public function getPinnedMessage() {
        return $this->pinnedMessage;
    }

    /**
     * @api
     * @param null|Message $pinnedMessage
     */
    public function setPinnedMessage(Message $pinnedMessage) {
        $this->pinnedMessage = $pinnedMessage;
    }

    /**
     * @return null|string
     */
    public function getStickerSetName() {
        return $this->stickerSetName;
    }

    /**
     * @param string $stickerSetName
     */
    public function setStickerSetName($stickerSetName) {
        $this->stickerSetName = $stickerSetName;
    }

    /**
     * @return null|bool
     */
    public function getCanSetStickerSet() {
        return $this->canSetStickerSet;
    }

    /**
     * @param bool $canSetStickerSet
     */
    public function setCanSetStickerSet($canSetStickerSet) {
        $this->canSetStickerSet = $canSetStickerSet;
    }
}
