<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#labeledprice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class LabeledPrice implements JsonSerializable, JsonDeserializer {

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var int $amount
     */
    private $amount;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setLabel($data['label']);
        $this->setAmount($data['amount']);
    }

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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {

        $data = array();

        $data['label'] = $this->getLabel();
        $data['amount'] = $this->getAmount();

        return $data;

    }
}
