<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ShippingOption;

class ShippingOptionTest extends TestCase {

    public function testAccessors() {

        $obj = new ShippingOption();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setPrices(array());

        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('array', gettype($obj->getPrices()));

        $this->assertJson(json_encode($obj));
    }
}
