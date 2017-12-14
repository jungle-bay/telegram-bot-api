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
use TelegramBotAPI\Types\Location;

/**
 * Class LocationTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
