<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#replykeyboardremove
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ReplyKeyboardRemove extends Type {

    /**
     * @var bool $removeKeyboard
     */
    private $removeKeyboard;

    /**
     * @var null|bool $selective
     */
    private $selective;


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
}
