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
use TelegramBotAPI\Types\KeyboardButton;

/**
 * Class KeyboardButtonTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class KeyboardButtonTest extends TestCase {

    public function testAccessors() {

        $obj = new KeyboardButton();

        $obj->setText('text');
        $obj->setRequestContact(true);
        $obj->setRequestLocation(true);

        $this->assertEquals('text', $obj->getText());
        $this->assertTrue($obj->isRequestContact());
        $this->assertTrue($obj->isRequestLocation());

        $this->assertJson(json_encode($obj));
    }
}
