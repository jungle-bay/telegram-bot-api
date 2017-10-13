<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Entities\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#messageentity
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class MessageEntity extends Type {

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var int $offset
     */
    private $offset;

    /**
     * @var int $length
     */
    private $length;

    /**
     * @var null|string $url
     */
    private $url;

    /**
     * @var null|User $user
     */
    private $user;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getOffset() {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset) {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * @return null|string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return null|User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param null|User $user
     */
    public function setUser($user) {
        $this->user = $user;
    }
}
