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


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\MessageEntity;

/**
 * Class MessageEntityTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class MessageEntityTest extends TestCase {

    public function testAccessors() {

        $obj = new MessageEntity();

        $obj->setUrl('url');
        $obj->setUser(new User());
        $obj->setOffset(1);
        $obj->setType('type');
        $obj->setLength(123);

        $this->assertEquals('url', $obj->getUrl());
        $this->assertInstanceOf(User::class, $obj->getUser());
        $this->assertEquals(1, $obj->getOffset());
        $this->assertEquals('type', $obj->getType());
        $this->assertEquals(123, $obj->getLength());

        $this->assertJson(json_encode($obj));
    }
}
