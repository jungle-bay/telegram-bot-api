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
 * Class ReplyKeyboardRemove
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
    public function isRemoveKeyboard() {
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
    public function isSelective() {
        return $this->selective;
    }

    /**
     * @param bool|null $selective
     */
    public function setSelective($selective) {
        $this->selective = $selective;
    }
}
