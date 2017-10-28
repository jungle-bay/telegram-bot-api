<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\TelegramBotAPIConstants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\OrderInfo;
use TelegramBotAPI\Types\SuccessfulPayment;

class SuccessfulPaymentTest extends TestCase {

    public function testAccessors() {

        $obj = new SuccessfulPayment();

        $obj->setCurrency(TelegramBotAPIConstants::CURRENCY_UAH);
        $obj->setInvoicePayload('invoice_payload');
        $obj->setShippingOptionId('shipping_option_id');
        $obj->setOrderInfo(new OrderInfo());
        $obj->setTotalAmount(1);
        $obj->setProviderPaymentChargeId('provider_payment_charge_id');
        $obj->setTelegramPaymentChargeId('telegram_payment_charge_id');

        $this->assertEquals(TelegramBotAPIConstants::CURRENCY_UAH, $obj->getCurrency());
        $this->assertEquals('invoice_payload', $obj->getInvoicePayload());
        $this->assertEquals('shipping_option_id', $obj->getShippingOptionId());
        $this->assertInstanceOf(OrderInfo::class, $obj->getOrderInfo());
        $this->assertEquals(1, $obj->getTotalAmount());
        $this->assertEquals('provider_payment_charge_id', $obj->getProviderPaymentChargeId());
        $this->assertEquals('telegram_payment_charge_id', $obj->getTelegramPaymentChargeId());

        $this->assertJson(json_encode($obj));
    }
}
