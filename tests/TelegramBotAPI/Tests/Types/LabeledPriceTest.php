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
use TelegramBotAPI\Types\LabeledPrice;

/**
 * Class LabeledPriceTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
