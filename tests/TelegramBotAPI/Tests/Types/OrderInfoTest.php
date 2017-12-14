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


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\OrderInfo;
use TelegramBotAPI\Types\ShippingAddress;

/**
 * Class OrderInfoTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class OrderInfoTest extends TestCase {

    public function testAccessors() {

        $obj = new OrderInfo();

        $obj->setName('name');
        $obj->setEmail('email');
        $obj->setPhoneNumber('phone_number');
        $obj->setShippingAddress(new ShippingAddress());

        $this->assertEquals('name', $obj->getName());
        $this->assertEquals('email', $obj->getEmail());
        $this->assertEquals('phone_number', $obj->getPhoneNumber());
        $this->assertInstanceOf(ShippingAddress::class, $obj->getShippingAddress());

        $this->assertJson(json_encode($obj));
    }
}
