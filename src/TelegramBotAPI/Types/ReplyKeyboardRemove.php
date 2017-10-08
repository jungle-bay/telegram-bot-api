<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#replykeyboardremove
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ReplyKeyboardRemove implements JsonSerializable, JsonDeserializer {

    /**
     * @var bool $removeKeyboard
     */
    private $removeKeyboard;

    /**
     * @var null|bool $selective
     */
    private $selective;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $this->setRemoveKeyboard($data['remove_keyboard']);

        if (isset($data['selective'])) $this->setRemoveKeyboard($data['selective']);
    }

    /**
     * @return bool
     */
    public function getRemoveKeyboard() {
        return $this->removeKeyboard;
    }

    /**
     * @param bool $removeKeyboard
     */
    public function setRemoveKeyboard($removeKeyboard) {
        $this->removeKeyboard = $removeKeyboard;
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

        $data['remove_keyboard'] = $this->getRemoveKeyboard();

        if (isset($this->selective)) $data['selective'] = $this->getSelective();

        return $data;
    }
}
