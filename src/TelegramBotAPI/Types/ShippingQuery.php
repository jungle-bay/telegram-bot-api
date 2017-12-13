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
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#shippingquery
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingQuery extends Type {

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
