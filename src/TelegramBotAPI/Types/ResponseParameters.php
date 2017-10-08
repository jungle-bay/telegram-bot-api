<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#responseparameters
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ResponseParameters implements JsonDeserializer {

    /**
     * @var null|int $migrateToChatId
     */
    private $migrateToChatId;

    /**
     * @var null|int $retryAfter
     */
    private $retryAfter;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (isset($data['migrate_to_chat_id'])) $this->setMigrateToChatId($data['migrate_to_chat_id']);
        if (isset($data['retry_after'])) $this->setRetryAfter($data['retry_after']);
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
    public function getRetryAfter() {
        return $this->retryAfter;
    }

    /**
     * @param int|null $retryAfter
     */
    public function setRetryAfter($retryAfter) {
        $this->retryAfter = $retryAfter;
    }
}
