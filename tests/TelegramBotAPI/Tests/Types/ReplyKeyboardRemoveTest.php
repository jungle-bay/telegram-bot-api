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
use TelegramBotAPI\Types\ReplyKeyboardRemove;

/**
 * Class ReplyKeyboardRemoveTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ReplyKeyboardRemoveTest extends TestCase {

    public function testAccessors() {

        $obj = new ReplyKeyboardRemove();

        $obj->setSelective(true);
        $obj->setRemoveKeyboard(false);

        $this->assertTrue($obj->isSelective());
        $this->assertFalse($obj->isRemoveKeyboard());

        $this->assertJson(json_encode($obj));
    }
}
