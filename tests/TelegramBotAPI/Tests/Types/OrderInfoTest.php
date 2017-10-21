<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\OrderInfo;
use TelegramBotAPI\Types\ShippingAddress;

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
