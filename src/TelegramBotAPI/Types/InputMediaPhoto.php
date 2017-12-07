<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 07.12.17
 * Time: 14:03
 */

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Traits\CaptionTrait;

/**
 * Class InputMediaPhoto
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputMediaPhoto extends InputMedia {

    use CaptionTrait;


    /**
     * @var string $type
     */
    private $type = 'photo';


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }
}
