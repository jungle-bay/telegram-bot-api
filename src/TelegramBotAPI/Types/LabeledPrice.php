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
 * Class LabeledPrice
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
