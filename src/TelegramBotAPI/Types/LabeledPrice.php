<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Entities\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#labeledprice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class LabeledPrice extends Type {

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var int $amount
     */
    private $amount;


    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * @return int
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount) {
        $this->amount = $amount;
    }
}
