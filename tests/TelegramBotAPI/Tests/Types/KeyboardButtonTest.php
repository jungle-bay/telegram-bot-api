<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\KeyboardButton;

class KeyboardButtonTest extends TestCase {

    public function testAccessors() {

        $obj = new KeyboardButton();

        $obj->setText('text');
        $obj->setRequestContact(true);
        $obj->setRequestLocation(true);

        $this->assertEquals('text', $obj->getText());
        $this->assertTrue($obj->getRequestContact());
        $this->assertTrue($obj->getRequestLocation());

        $this->assertJson(json_encode($obj));
    }
}
