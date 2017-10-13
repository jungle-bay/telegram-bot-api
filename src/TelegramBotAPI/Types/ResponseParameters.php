<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Entities\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#responseparameters
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ResponseParameters extends Type {

    /**
     * @var null|int $migrateToChatId
     */
    private $migrateToChatId;

    /**
     * @var null|int $retryAfter
     */
    private $retryAfter;


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
