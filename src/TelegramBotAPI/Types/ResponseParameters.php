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
 * Class ResponseParameters
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#responseparameters
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ResponseParameters extends Type {

    /**
     * @var null|float $migrateToChatId
     */
    private $migrateToChatId;

    /**
     * @var null|int $retryAfter
     */
    private $retryAfter;


    /**
     * @return float|null
     */
    public function getMigrateToChatId() {
        return $this->migrateToChatId;
    }

    /**
     * @param float|null $migrateToChatId
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
