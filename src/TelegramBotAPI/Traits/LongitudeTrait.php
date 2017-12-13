<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Traits;


/**
 * Trait LongitudeTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait LongitudeTrait {


    /**
     * @var float $longitude
     */
    protected $longitude;


    /**
     * @api
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @api
     * @param float $longitude
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
}
