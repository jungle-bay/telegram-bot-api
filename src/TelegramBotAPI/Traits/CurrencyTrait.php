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
 * Trait CurrencyTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait CurrencyTrait {

    /**
     * @var string $currency
     */
    protected $currency;


    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
    }
}
