<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 06.12.17
 * Time: 11:14
 */

namespace TelegramBotAPI\Types;


/**
 * Class Keyboard
 * @package TelegramBotAPI\Types
 */
abstract class Keyboard extends Type {

    /**
     * {@inheritdoc}
     */
    public function __toString() {

        $data = $this->jsonSerialize();

        return json_encode($data);
    }
}
