<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#successfulpayment
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class SuccessfulPayment implements JsonDeserializer {

    /**
     * @var string $currency
     */
    private $currency;

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
     * @var string $telegramPaymentChargeId
     */
    private $telegramPaymentChargeId;

    /**
     * @var string $providerPaymentChargeId
     */
    private $providerPaymentChargeId;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setCurrency($data['currency']);
        $this->setTotalAmount($data['total_amount']);
        $this->setInvoicePayload($data['invoice_payload']);

        if (isset($data['shipping_option_id'])) $this->setShippingOptionId($data['shipping_option_id']);
        if (isset($data['order_info'])) $this->setOrderInfo(new OrderInfo($data['order_info']));

        $this->setTelegramPaymentChargeId($data['telegram_payment_charge_id']);
        $this->setProviderPaymentChargeId($data['provider_payment_charge_id']);
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

    /**
     * @return string
     */
    public function getTelegramPaymentChargeId() {
        return $this->telegramPaymentChargeId;
    }

    /**
     * @param string $telegramPaymentChargeId
     */
    public function setTelegramPaymentChargeId($telegramPaymentChargeId) {
        $this->telegramPaymentChargeId = $telegramPaymentChargeId;
    }

    /**
     * @return string
     */
    public function getProviderPaymentChargeId() {
        return $this->providerPaymentChargeId;
    }

    /**
     * @param string $providerPaymentChargeId
     */
    public function setProviderPaymentChargeId($providerPaymentChargeId) {
        $this->providerPaymentChargeId = $providerPaymentChargeId;
    }
}
