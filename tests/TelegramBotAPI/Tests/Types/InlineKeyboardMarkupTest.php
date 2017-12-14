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
use TelegramBotAPI\Types\InlineKeyboardMarkup;

/**
 * Class InlineKeyboardMarkupTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardMarkupTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineKeyboardMarkup();

        $obj->setInlineKeyboard(array());

        $this->assertEquals('array', gettype($obj->getInlineKeyboard()));

        $this->assertJson(json_encode($obj));
    }
}
