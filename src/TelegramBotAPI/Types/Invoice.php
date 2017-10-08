<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#invoice
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Invoice implements JsonDeserializerInterface {

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $startParameter
     */
    private $startParameter;

    /**
     * @var string $currency
     */
    private $currency;

    /**
     * @var int $totalAmount
     */
    private $totalAmount;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setTitle($data['title']);
        $this->setDescription($data['description']);
        $this->setStartParameter($data['start_parameter']);
        $this->setCurrency($data['currency']);
        $this->setTotalAmount($data['total_amount']);
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
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getStartParameter() {
        return $this->startParameter;
    }

    /**
     * @param string $startParameter
     */
    public function setStartParameter($startParameter) {
        $this->startParameter = $startParameter;
    }

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

    /**
     * @return int
     */
    public function getTotalAmount() {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     */
    public function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }
}
