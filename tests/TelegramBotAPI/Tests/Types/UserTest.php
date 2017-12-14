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


use TelegramBotAPI\Constants;
use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class UserTest extends TestCase {

    public function testAccessors() {

        $obj = new User();

        $obj->setId(123456);
        $obj->setUsername('username');
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');
        $obj->setBot(true);
        $obj->setLanguageCode(Constants::CURRENCY_UAH);

        $this->assertEquals(123456, $obj->getId());
        $this->assertEquals('username', $obj->getUsername());
        $this->assertEquals('first_name', $obj->getFirstName());
        $this->assertEquals('last_name', $obj->getLastName());
        $this->assertTrue($obj->isBot());
        $this->assertEquals(Constants::CURRENCY_UAH, $obj->getLanguageCode());

        $this->assertJson(json_encode($obj));
    }
}
