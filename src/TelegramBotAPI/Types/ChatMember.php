<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Types;


/**
 * Class ChatMember
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#chatmember
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChatMember extends Type {

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
    public function isCanBeEdited() {
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
    public function isCanChangeInfo() {
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
    public function isCanPostMessages() {
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
    public function isCanEditMessages() {
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
    public function isCanDeleteMessages() {
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
    public function isCanInviteUsers() {
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
    public function isCanRestrictMembers() {
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
    public function isCanPinMessages() {
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
    public function isCanPromoteMembers() {
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
    public function isCanSendMessages() {
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
    public function isCanSendMediaMessages() {
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
    public function isCanSendOtherMessages() {
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
    public function isCanAddWebPagePreviews() {
        return $this->canAddWebPagePreviews;
    }

    /**
     * @api
     * @param bool|null $canAddWebPagePreviews
     */
    public function setCanAddWebPagePreviews($canAddWebPagePreviews) {
        $this->canAddWebPagePreviews = $canAddWebPagePreviews;
    }
}
