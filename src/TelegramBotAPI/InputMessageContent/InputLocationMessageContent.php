<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Traits\LatitudeTrait;
use TelegramBotAPI\Traits\LongitudeTrait;

/**
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputlocationmessagecontent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputLocationMessageContent extends InputMessageContent {

    use LatitudeTrait;
    use LongitudeTrait;


    /**
     * @var null|int $longitude
     */
    private $livePeriod;


    /**
     * @return null|int
     */
    public function getLivePeriod() {
        return $this->livePeriod;
    }

    /**
     * @param int $livePeriod
     */
    public function setLivePeriod($livePeriod) {
        $this->livePeriod = $livePeriod;
    }
}
