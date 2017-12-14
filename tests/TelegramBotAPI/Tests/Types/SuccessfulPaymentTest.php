<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\OrderInfo;
use TelegramBotAPI\Types\SuccessfulPayment;

/**
 * Class SuccessfulPaymentTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class SuccessfulPaymentTest extends TestCase {

    public function testAccessors() {

        $obj = new SuccessfulPayment();

        $obj->setCurrency(Constants::CURRENCY_UAH);
        $obj->setInvoicePayload('invoice_payload');
        $obj->setShippingOptionId('shipping_option_id');
        $obj->setOrderInfo(new OrderInfo());
        $obj->setTotalAmount(1);
        $obj->setProviderPaymentChargeId('provider_payment_charge_id');
        $obj->setTelegramPaymentChargeId('telegram_payment_charge_id');

        $this->assertEquals(Constants::CURRENCY_UAH, $obj->getCurrency());
        $this->assertEquals('invoice_payload', $obj->getInvoicePayload());
        $this->assertEquals('shipping_option_id', $obj->getShippingOptionId());
        $this->assertInstanceOf(OrderInfo::class, $obj->getOrderInfo());
        $this->assertEquals(1, $obj->getTotalAmount());
        $this->assertEquals('provider_payment_charge_id', $obj->getProviderPaymentChargeId());
        $this->assertEquals('telegram_payment_charge_id', $obj->getTelegramPaymentChargeId());

        $this->assertJson(json_encode($obj));
    }
}
