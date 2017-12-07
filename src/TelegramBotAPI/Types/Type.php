<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\GSON;

/**
 * Class Type
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#available-types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class Type extends GSON {

    /**
     * {@inheritdoc}
     */
    public function __toString() {

        $data = $this->jsonSerialize();

        return json_encode($data);
    }
}
