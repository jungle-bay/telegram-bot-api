<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ReplyKeyboardMarkup extends Type {

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
}
