<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\TelegramBotAPIConstants;
use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    public function testAccessors() {

        $obj = new User();

        $obj->setId(123456);
        $obj->setUsername('username');
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');
        $obj->setBot(true);
        $obj->setLanguageCode(TelegramBotAPIConstants::CURRENCY_UAH);

        $this->assertEquals(123456, $obj->getId());
        $this->assertEquals('username', $obj->getUsername());
        $this->assertEquals('first_name', $obj->getFirstName());
        $this->assertEquals('last_name', $obj->getLastName());
        $this->assertTrue($obj->getBot());
        $this->assertEquals(TelegramBotAPIConstants::CURRENCY_UAH, $obj->getLanguageCode());

        $this->assertJson(json_encode($obj));
    }
}
