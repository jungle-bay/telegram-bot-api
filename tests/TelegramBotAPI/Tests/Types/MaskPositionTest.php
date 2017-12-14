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
use TelegramBotAPI\Types\MaskPosition;

/**
 * Class MaskPositionTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class MaskPositionTest extends TestCase {

    public function testAccessors() {

        $obj = new MaskPosition();

        $obj->setScale(3.3);
        $obj->setPoint('1 1');
        $obj->setXShift(2.2);
        $obj->setYShift(1.1);

        $this->assertEquals(3.3, $obj->getScale());
        $this->assertEquals('1 1', $obj->getPoint());
        $this->assertEquals(2.2, $obj->getXShift());
        $this->assertEquals(1.1, $obj->getYShift());

        $this->assertJson(json_encode($obj));
    }
}
