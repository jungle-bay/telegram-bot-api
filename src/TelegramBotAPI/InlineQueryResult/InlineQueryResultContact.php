<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\ThumbHeightTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\ThumbWidthTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcontact
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultContact extends InlineQueryResult {

    use InputMessageContentTrait;
    use ThumbUrlTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;


    /**
     * @var string
     */
    private $type = 'contact';

    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var null|string $lastName
     */
    private $lastName;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param null|string $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
}
