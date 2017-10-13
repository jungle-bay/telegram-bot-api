<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Entities\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#shippingoption
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingOption extends Type {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var LabeledPrice[] $prices
     */
    private $prices;


    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return LabeledPrice[]
     */
    public function getPrices() {
        return $this->prices;
    }

    /**
     * @param LabeledPrice[] $prices
     */
    public function setPrices($prices) {
        $this->prices = $prices;
    }
}
