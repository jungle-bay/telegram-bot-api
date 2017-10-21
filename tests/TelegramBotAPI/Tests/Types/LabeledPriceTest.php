<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\LabeledPrice;

class LabeledPriceTest extends TestCase {

    public function testAccessors() {

        $obj = new LabeledPrice();

        $obj->setLabel('label');
        $obj->setAmount(1);

        $this->assertEquals('label', $obj->getLabel());
        $this->assertEquals(1, $obj->getAmount());

        $this->assertJson(json_encode($obj));
    }
}
