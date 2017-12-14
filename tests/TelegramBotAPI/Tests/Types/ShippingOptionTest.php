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
use TelegramBotAPI\Types\ShippingOption;

/**
 * Class ShippingOptionTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
