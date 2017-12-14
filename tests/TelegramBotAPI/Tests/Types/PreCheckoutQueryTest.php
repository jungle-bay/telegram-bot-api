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
use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\OrderInfo;
use TelegramBotAPI\Types\PreCheckoutQuery;

/**
 * Class PreCheckoutQueryTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class PreCheckoutQueryTest extends TestCase {

    public function testAccessors() {

        $obj = new PreCheckoutQuery();

        $obj->setId('id');
        $obj->setFrom(new User());
        $obj->setTotalAmount(1);
        $obj->setCurrency(Constants::CURRENCY_UAH);
        $obj->setInvoicePayload('invoice_payload');
        $obj->setOrderInfo(new OrderInfo());
        $obj->setShippingOptionId('shipping_option_id');

        $this->assertEquals('id', $obj->getId());
        $this->assertInstanceOf(User::class, $obj->getFrom());
        $this->assertEquals(1, $obj->getTotalAmount());
        $this->assertEquals(Constants::CURRENCY_UAH, $obj->getCurrency());
        $this->assertEquals('invoice_payload', $obj->getInvoicePayload());
        $this->assertInstanceOf(OrderInfo::class, $obj->getOrderInfo());
        $this->assertEquals('shipping_option_id', $obj->getShippingOptionId());

        $this->assertJson(json_encode($obj));
    }
}
