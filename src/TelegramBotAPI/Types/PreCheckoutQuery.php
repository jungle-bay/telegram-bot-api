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


use TelegramBotAPI\Traits\CurrencyTrait;

/**
 * Class PreCheckoutQuery
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#precheckoutquery
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class PreCheckoutQuery extends Type {

    use CurrencyTrait;


    /**
     * @var string $id
     */
    private $id;

    /**
     * @var User $from
     */
    private $from;


    /**
     * @var int $totalAmount
     */
    private $totalAmount;

    /**
     * @var string $invoicePayload
     */
    private $invoicePayload;

    /**
     * @var null|string $shippingOptionId
     */
    private $shippingOptionId;

    /**
     * @var null|OrderInfo $orderInfo
     */
    private $orderInfo;


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
     * @return User
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @param User $from
     */
    public function setFrom($from) {
        $this->from = $from;
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

    /**
     * @return string
     */
    public function getInvoicePayload() {
        return $this->invoicePayload;
    }

    /**
     * @param string $invoicePayload
     */
    public function setInvoicePayload($invoicePayload) {
        $this->invoicePayload = $invoicePayload;
    }

    /**
     * @return null|string
     */
    public function getShippingOptionId() {
        return $this->shippingOptionId;
    }

    /**
     * @param null|string $shippingOptionId
     */
    public function setShippingOptionId($shippingOptionId) {
        $this->shippingOptionId = $shippingOptionId;
    }

    /**
     * @return null|OrderInfo
     */
    public function getOrderInfo() {
        return $this->orderInfo;
    }

    /**
     * @param null|OrderInfo $orderInfo
     */
    public function setOrderInfo($orderInfo) {
        $this->orderInfo = $orderInfo;
    }
}
