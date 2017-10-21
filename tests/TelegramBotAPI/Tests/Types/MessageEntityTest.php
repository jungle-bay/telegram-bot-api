<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\MessageEntity;

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
