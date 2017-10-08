<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ReplyKeyboardMarkup implements JsonSerializable, JsonDeserializerInterface {

    /**
     * @var array KeyboardButton[] $keyboard
     */
    private $keyboard;

    /**
     * @var null|bool $resizeKeyboard
     */
    private $resizeKeyboard;

    /**
     * @var null|bool $oneTimeKeyboard
     */
    private $oneTimeKeyboard;

    /**
     * @var null|bool $selective
     */
    private $selective;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        if (empty($data)) return;

        $keyboard = array();

        foreach ($data['keyboard'] as $row) {

            $tmpRow = array();

            foreach ($row as $button) {
                $tmpRow[] = new KeyboardButton($button);
            }

            $keyboard[] = $tmpRow;
        }

        $this->setKeyboard($keyboard);

        if (isset($data['resize_keyboard'])) $this->setResizeKeyboard($data['resize_keyboard']);
        if (isset($data['one_time_keyboard'])) $this->setOneTimeKeyboard($data['one_time_keyboard']);
        if (isset($data['selective'])) $this->setSelective($data['selective']);
    }

    /**
     * @return array
     */
    public function getKeyboard() {
        return $this->keyboard;
    }

    /**
     * @param array $keyboard
     */
    public function setKeyboard($keyboard) {
        $this->keyboard = $keyboard;
    }

    /**
     * @return bool|null
     */
    public function getResizeKeyboard() {
        return $this->resizeKeyboard;
    }

    /**
     * @param bool|null $resizeKeyboard
     */
    public function setResizeKeyboard($resizeKeyboard) {
        $this->resizeKeyboard = $resizeKeyboard;
    }

    /**
     * @return bool|null
     */
    public function getOneTimeKeyboard() {
        return $this->oneTimeKeyboard;
    }

    /**
     * @param bool|null $oneTimeKeyboard
     */
    public function setOneTimeKeyboard($oneTimeKeyboard) {
        $this->oneTimeKeyboard = $oneTimeKeyboard;
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

        foreach ($this->getKeyboard() as $row) {

            $tmpRow = array();

            foreach ($row as $button) {

                /** @var KeyboardButton $button */
                $tmpRow[] = $button;
            }

            $data['keyboard'][] = $tmpRow;
        }

        if (isset($this->resizeKeyboard)) $data['resize_keyboard'] = $this->getResizeKeyboard();
        if (isset($this->oneTimeKeyboard)) $data['one_time_keyboard'] = $this->getOneTimeKeyboard();
        if (isset($this->selective)) $data['selective'] = $this->getSelective();

        return $data;
    }
}
