<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Venue;
use TelegramBotAPI\Types\Location;

class VenueTest extends TestCase {

    public function testAccessors() {

        $obj = new Venue();

        $obj->setTitle('title');
        $obj->setLocation(new Location());
        $obj->setAddress('address');
        $obj->setFoursquareId('foursquare_id');

        $this->assertEquals('title', $obj->getTitle());
        $this->assertInstanceOf(Location::class, $obj->getLocation());
        $this->assertEquals('address', $obj->getAddress());
        $this->assertEquals('foursquare_id', $obj->getFoursquareId());

        $this->assertJson(json_encode($obj));
    }
}
