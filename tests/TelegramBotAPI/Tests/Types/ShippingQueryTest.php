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


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ShippingQuery;
use TelegramBotAPI\Types\ShippingAddress;

/**
 * Class ShippingQueryTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingQueryTest extends TestCase {

    public function testAccessors() {

        $obj = new ShippingQuery();

        $obj->setId('id');
        $obj->setFrom(new User());
        $obj->setInvoicePayload('invoice_payload');
        $obj->setShippingAddress(new ShippingAddress());

        $this->assertEquals('id', $obj->getId());
        $this->assertInstanceOf(User::class, $obj->getFrom());
        $this->assertEquals('invoice_payload', $obj->getInvoicePayload());
        $this->assertInstanceOf(ShippingAddress::class, $obj->getShippingAddress());

        $this->assertJson(json_encode($obj));
    }
}
