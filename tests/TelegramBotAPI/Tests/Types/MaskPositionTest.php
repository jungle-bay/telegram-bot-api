<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\MaskPosition;

class MaskPositionTest extends TestCase {

    public function testAccessors() {

        $obj = new MaskPosition();

        $obj->setZoom(3.3);
        $obj->setPoint('1 1');
        $obj->setXShift(2.2);
        $obj->setYShift(1.1);

        $this->assertEquals(3.3, $obj->getZoom());
        $this->assertEquals('1 1', $obj->getPoint());
        $this->assertEquals(2.2, $obj->getXShift());
        $this->assertEquals(1.1, $obj->getYShift());

        $this->assertJson(json_encode($obj));
    }
}
