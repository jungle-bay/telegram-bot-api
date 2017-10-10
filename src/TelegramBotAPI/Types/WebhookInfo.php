<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#webhookinfo
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class WebhookInfo implements JsonDeserializerInterface {

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var bool $hasCustomCertificate
     */
    private $hasCustomCertificate;

    /**
     * @var int $pendingUpdateCount
     */
    private $pendingUpdateCount;

    /**
     * @var null|int $lastErrorDate
     */
    private $lastErrorDate;

    /**
     * @var null|string $lastErrorMessage
     */
    private $lastErrorMessage;

    /**
     * @var null|int $maxConnections
     */
    private $maxConnections;

    /**
     * @var null|string[] $allowedUpdates
     */
    private $allowedUpdates;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setUrl($data['url']);
        $this->setHasCustomCertificate($data['has_custom_certificate']);
        $this->setPendingUpdateCount($data['pending_update_count']);

        if (isset($data['last_error_date'])) $this->setLastErrorDate($data['last_error_date']);
        if (isset($data['last_error_message'])) $this->setLastErrorMessage($data['last_error_message']);
        if (isset($data['max_connections'])) $this->setMaxConnections($data['max_connections']);
        if (isset($data['allowed_updates'])) $this->setAllowedUpdates($data['allowed_updates']);
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isHasCustomCertificate() {
        return $this->hasCustomCertificate;
    }

    /**
     * @param bool $hasCustomCertificate
     */
    public function setHasCustomCertificate($hasCustomCertificate) {
        $this->hasCustomCertificate = $hasCustomCertificate;
    }

    /**
     * @return int
     */
    public function getPendingUpdateCount() {
        return $this->pendingUpdateCount;
    }

    /**
     * @param int $pendingUpdateCount
     */
    public function setPendingUpdateCount($pendingUpdateCount) {
        $this->pendingUpdateCount = $pendingUpdateCount;
    }

    /**
     * @return int|null
     */
    public function getLastErrorDate() {
        return $this->lastErrorDate;
    }

    /**
     * @param int|null $lastErrorDate
     */
    public function setLastErrorDate($lastErrorDate) {
        $this->lastErrorDate = $lastErrorDate;
    }

    /**
     * @return null|string
     */
    public function getLastErrorMessage() {
        return $this->lastErrorMessage;
    }

    /**
     * @param null|string $lastErrorMessage
     */
    public function setLastErrorMessage($lastErrorMessage) {
        $this->lastErrorMessage = $lastErrorMessage;
    }

    /**
     * @return int|null
     */
    public function getMaxConnections() {
        return $this->maxConnections;
    }

    /**
     * @param int|null $maxConnections
     */
    public function setMaxConnections($maxConnections) {
        $this->maxConnections = $maxConnections;
    }

    /**
     * @return null|string[]
     */
    public function getAllowedUpdates() {
        return $this->allowedUpdates;
    }

    /**
     * @param null|string[] $allowedUpdates
     */
    public function setAllowedUpdates($allowedUpdates) {
        $this->allowedUpdates = $allowedUpdates;
    }
}
