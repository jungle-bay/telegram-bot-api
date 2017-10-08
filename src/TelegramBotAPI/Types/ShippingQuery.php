<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#shippingquery
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingQuery implements JsonDeserializerInterface {

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var User $from
     */
    private $from;

    /**
     * @var string $invoicePayload
     */
    private $invoicePayload;

    /**
     * @var ShippingAddress $shippingAddress
     */
    private $shippingAddress;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setId($data['id']);
        $this->setFrom(new User($data['from']));
        $this->setInvoicePayload($data['invoice_payload']);
        $this->setShippingAddress(new ShippingAddress($data['shipping_address']));
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
     * @return ShippingAddress
     */
    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    /**
     * @param ShippingAddress $shippingAddress
     */
    public function setShippingAddress($shippingAddress) {
        $this->shippingAddress = $shippingAddress;
    }
}
