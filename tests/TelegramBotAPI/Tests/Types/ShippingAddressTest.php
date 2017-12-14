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
use TelegramBotAPI\Types\ShippingAddress;

/**
 * Class ShippingAddressTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ShippingAddressTest extends TestCase {

    public function testAccessors() {

        $obj = new ShippingAddress();

        $obj->setCity('city');
        $obj->setCountryCode('123');
        $obj->setPostCode('321');
        $obj->setState('ok');
        $obj->setStreetLine1('street_line_1');
        $obj->setStreetLine2('street_line_2');

        $this->assertEquals('city', $obj->getCity());
        $this->assertEquals('123', $obj->getCountryCode());
        $this->assertEquals('321', $obj->getPostCode());
        $this->assertEquals('ok', $obj->getState());
        $this->assertEquals('street_line_1', $obj->getStreetLine1());
        $this->assertEquals('street_line_2', $obj->getStreetLine2());

        $this->assertJson(json_encode($obj));
    }
}
