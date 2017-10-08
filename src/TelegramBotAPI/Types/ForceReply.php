<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#forcereply
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ForceReply implements JsonSerializable, JsonDeserializerInterface {

    /**
     * @var bool $forceReply
     */
    private $forceReply;

    /**
     * @var null|bool $selective
     */
    private $selective;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $this->setForceReply($data['force_reply']);

        if (isset($data['selective'])) $this->setSelective($data['selective']);
    }

    /**
     * @return bool
     */
    public function getForceReply() {
        return $this->forceReply;
    }

    /**
     * @param bool $forceReply
     */
    public function setForceReply($forceReply) {
        $this->forceReply = $forceReply;
    }

    /**
     * @return bool|null
     */
    public function getSelective() {
        return $this->selective;
    }

    /**
     * @param bool|null $selective
     */
    public function setSelective($selective) {
        $this->selective = $selective;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {

        $data = array();

        $data['force_reply'] = $this->getForceReply();

        if (isset($this->selective)) $data['selective'] = $this->getSelective();

        return $data;
    }
}
