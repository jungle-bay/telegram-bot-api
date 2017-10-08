<?php

namespace TelegramBotAPI\Types;


use JsonSerializable;
use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#shippingoption
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingOption implements JsonSerializable, JsonDeserializerInterface {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setId($data['id']);
        $this->setTitle($data['title']);

        $prices = array();

        foreach ($data['prices'] as $price) $prices[] = new LabeledPrice($price);

        $this->setPrices($prices);
    }

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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {

        $data = array();


        $data['id'] = $this->getId();
        $data['title'] = $this->getTitle();

        foreach ($this->getPrices() as $price) {
            $data['price'][] = $price;
        }

        return $data;
    }
}
