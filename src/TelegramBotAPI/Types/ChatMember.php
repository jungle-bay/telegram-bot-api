<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#chatmember
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChatMember implements JsonDeserializer {

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var string $status
     */
    private $status;

    /**
     * @var null|int $untilDate
     */
    private $untilDate;

    /**
     * @var null|bool $canBeEdited
     */
    private $canBeEdited;

    /**
     * @var null|bool $canChangeInfo
     */
    private $canChangeInfo;

    /**
     * @var null|bool $canPostMessages
     */
    private $canPostMessages;

    /**
     * @var null|bool $canEditMessages
     */
    private $canEditMessages;

    /**
     * @var null|bool $canDeleteMessages
     */
    private $canDeleteMessages;

    /**
     * @var null|bool $canInviteUsers
     */
    private $canInviteUsers;

    /**
     * @var null|bool $canRestrictMembers
     */
    private $canRestrictMembers;

    /**
     * @var null|bool $canPinMessages
     */
    private $canPinMessages;

    /**
     * @var null|bool $canPromoteMembers
     */
    private $canPromoteMembers;

    /**
     * @var null|bool $canSendMessages
     */
    private $canSendMessages;

    /**
     * @var null|bool $canSendMediaMessages
     */
    private $canSendMediaMessages;

    /**
     * @var null|bool $canSendOtherMessages
     */
    private $canSendOtherMessages;

    /**
     * @var null|bool $canAddWebPagePreviews
     */
    private $canAddWebPagePreviews;


    /**
     * @api
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @api
     * @param User $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @api
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @api
     * @param string $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @api
     * @return int|null
     */
    public function getUntilDate() {
        return $this->untilDate;
    }

    /**
     * @api
     * @param int|null $untilDate
     */
    public function setUntilDate($untilDate) {
        $this->untilDate = $untilDate;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanBeEdited() {
        return $this->canBeEdited;
    }

    /**
     * @api
     * @param bool|null $canBeEdited
     */
    public function setCanBeEdited($canBeEdited) {
        $this->canBeEdited = $canBeEdited;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanChangeInfo() {
        return $this->canChangeInfo;
    }

    /**
     * @api
     * @param bool|null $canChangeInfo
     */
    public function setCanChangeInfo($canChangeInfo) {
        $this->canChangeInfo = $canChangeInfo;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanPostMessages() {
        return $this->canPostMessages;
    }

    /**
     * @api
     * @param bool|null $canPostMessages
     */
    public function setCanPostMessages($canPostMessages) {
        $this->canPostMessages = $canPostMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanEditMessages() {
        return $this->canEditMessages;
    }

    /**
     * @api
     * @param bool|null $canEditMessages
     */
    public function setCanEditMessages($canEditMessages) {
        $this->canEditMessages = $canEditMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanDeleteMessages() {
        return $this->canDeleteMessages;
    }

    /**
     * @api
     * @param bool|null $canDeleteMessages
     */
    public function setCanDeleteMessages($canDeleteMessages) {
        $this->canDeleteMessages = $canDeleteMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanInviteUsers() {
        return $this->canInviteUsers;
    }

    /**
     * @api
     * @param bool|null $canInviteUsers
     */
    public function setCanInviteUsers($canInviteUsers) {
        $this->canInviteUsers = $canInviteUsers;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanRestrictMembers() {
        return $this->canRestrictMembers;
    }

    /**
     * @api
     * @param bool|null $canRestrictMembers
     */
    public function setCanRestrictMembers($canRestrictMembers) {
        $this->canRestrictMembers = $canRestrictMembers;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanPinMessages() {
        return $this->canPinMessages;
    }

    /**
     * @api
     * @param bool|null $canPinMessages
     */
    public function setCanPinMessages($canPinMessages) {
        $this->canPinMessages = $canPinMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanPromoteMembers() {
        return $this->canPromoteMembers;
    }

    /**
     * @api
     * @param bool|null $canPromoteMembers
     */
    public function setCanPromoteMembers($canPromoteMembers) {
        $this->canPromoteMembers = $canPromoteMembers;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanSendMessages() {
        return $this->canSendMessages;
    }

    /**
     * @api
     * @param bool|null $canSendMessages
     */
    public function setCanSendMessages($canSendMessages) {
        $this->canSendMessages = $canSendMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanSendMediaMessages() {
        return $this->canSendMediaMessages;
    }

    /**
     * @api
     * @param bool|null $canSendMediaMessages
     */
    public function setCanSendMediaMessages($canSendMediaMessages) {
        $this->canSendMediaMessages = $canSendMediaMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanSendOtherMessages() {
        return $this->canSendOtherMessages;
    }

    /**
     * @api
     * @param bool|null $canSendOtherMessages
     */
    public function setCanSendOtherMessages($canSendOtherMessages) {
        $this->canSendOtherMessages = $canSendOtherMessages;
    }

    /**
     * @api
     * @return bool|null
     */
    public function getCanAddWebPagePreviews() {
        return $this->canAddWebPagePreviews;
    }

    /**
     * @api
     * @param bool|null $canAddWebPagePreviews
     */
    public function setCanAddWebPagePreviews($canAddWebPagePreviews) {
        $this->canAddWebPagePreviews = $canAddWebPagePreviews;
    }

    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setUser(new User($data['user']));
        $this->setStatus($data['status']);

        if (isset($data['until_date'])) {
            $this->setUntilDate($data['until_date']);
        }

        if (isset($data['can_be_edited'])) {
            $this->setCanBeEdited($data['can_be_edited']);
        }

        if (isset($data['can_change_info'])) {
            $this->setCanChangeInfo($data['can_change_info']);
        }

        if (isset($data['can_post_messages'])) {
            $this->setCanPostMessages($data['can_post_messages']);
        }

        if (isset($data['can_edit_messages'])) {
            $this->setCanEditMessages($data['can_edit_messages']);
        }

        if (isset($data['can_delete_messages'])) {
            $this->setCanDeleteMessages($data['can_delete_messages']);
        }

        if (isset($data['can_invite_users'])) {
            $this->setCanInviteUsers($data['can_invite_users']);
        }

        if (isset($data['can_restrict_members'])) {
            $this->setCanRestrictMembers($data['can_restrict_members']);
        }

        if (isset($data['can_pin_messages'])) {
            $this->setCanPinMessages($data['can_pin_messages']);
        }

        if (isset($data['can_promote_members'])) {
            $this->setCanPromoteMembers($data['can_promote_members']);
        }

        if (isset($data['can_send_messages'])) {
            $this->setCanSendMessages($data['can_send_messages']);
        }

        if (isset($data['can_send_media_messages'])) {
            $this->setCanSendMediaMessages($data['can_send_media_messages']);
        }

        if (isset($data['can_send_other_messages'])) {
            $this->setCanSendOtherMessages($data['can_send_other_messages']);
        }

        if (isset($data['can_add_web_page_previews'])) {
            $this->setCanAddWebPagePreviews($data['can_add_web_page_previews']);
        }
    }
}
