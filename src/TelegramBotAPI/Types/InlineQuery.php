<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inlinequery
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQuery implements JsonDeserializer {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var User $from
     */
    private $from;

    /**
     * @var null|Location $location
     */
    private $location;

    /**
     * @var string $query
     */
    private $query;

    /**
     * @var string $offset
     */
    private $offset;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setId($data['id']);
        $this->setFrom(new User($data['from']));

        if (isset($data['location'])) $this->setLocation(new Location($data['location']));

        $this->setQuery($data['query']);
        $this->setOffset($data['offset']);
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @param User $from
     */
    public function setFrom($from) {
        $this->from = $from;
    }

    /**
     * @return null|Location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param null|Location $location
     */
    public function setLocation($location) {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query) {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getOffset() {
        return $this->offset;
    }

    /**
     * @param string $offset
     */
    public function setOffset($offset) {
        $this->offset = $offset;
    }
}
