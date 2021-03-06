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
 * Class ChosenInlineResult
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#choseninlineresult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChosenInlineResult extends Type {

    /**
     * @var string $resultId
     */
    private $resultId;

    /**
     * @var User $from
     */
    private $from;

    /**
     * @var null|Location $location
     */
    private $location;

    /**
     * @var null|string $inlineMessageId
     */
    private $inlineMessageId;

    /**
     * @var string $query
     */
    private $query;


    /**
     * @api
     * @return string
     */
    public function getResultId() {
        return $this->resultId;
    }

    /**
     * @api
     * @param string $resultId
     */
    public function setResultId($resultId) {
        $this->resultId = $resultId;
    }

    /**
     * @api
     * @return User
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @api
     * @param User $from
     */
    public function setFrom($from) {
        $this->from = $from;
    }

    /**
     * @api
     * @return null|Location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @api
     * @param null|Location $location
     */
    public function setLocation($location) {
        $this->location = $location;
    }

    /**
     * @api
     * @return null|string
     */
    public function getInlineMessageId() {
        return $this->inlineMessageId;
    }

    /**
     * @api
     * @param null|string $inlineMessageId
     */
    public function setInlineMessageId($inlineMessageId) {
        $this->inlineMessageId = $inlineMessageId;
    }

    /**
     * @api
     * @return string
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * @api
     * @param string $query
     */
    public function setQuery($query) {
        $this->query = $query;
    }
}
