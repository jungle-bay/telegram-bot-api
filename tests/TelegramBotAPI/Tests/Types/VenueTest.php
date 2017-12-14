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
use TelegramBotAPI\Types\Venue;
use TelegramBotAPI\Types\Location;

/**
 * Class VenueTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
