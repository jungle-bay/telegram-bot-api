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
 * Class ReplyKeyboardMarkup
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
    public function isResizeKeyboard() {
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
    public function isOneTimeKeyboard() {
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
