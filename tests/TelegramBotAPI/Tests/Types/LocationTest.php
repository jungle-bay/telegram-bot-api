<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Location;

class LocationTest extends TestCase {

    public function testAccessors() {

        $obj = new Location();

        $obj->setLatitude(2.2);
        $obj->setLongitude(1.1);

        $this->assertEquals(1.1, $obj->getLongitude());
        $this->assertEquals(2.2, $obj->getLatitude());

        $this->assertJson(json_encode($obj));
    }
}
