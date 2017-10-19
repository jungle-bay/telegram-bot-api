<?php

namespace TelegramBotAPI\Types\Traits;


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
