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
use TelegramBotAPI\Types\ReplyKeyboardMarkup;

/**
 * Class ReplyKeyboardMarkupTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ReplyKeyboardMarkupTest extends TestCase {

    public function testAccessors() {

        $obj = new ReplyKeyboardMarkup();

        $obj->setSelective(true);
        $obj->setKeyboard(array());
        $obj->setOneTimeKeyboard(true);
        $obj->setResizeKeyboard(true);

        $this->assertTrue($obj->isSelective());
        $this->assertEquals('array', gettype($obj->getKeyboard()));
        $this->assertTrue($obj->isOneTimeKeyboard());
        $this->assertTrue($obj->isResizeKeyboard());

        $this->assertJson(json_encode($obj));
    }
}
