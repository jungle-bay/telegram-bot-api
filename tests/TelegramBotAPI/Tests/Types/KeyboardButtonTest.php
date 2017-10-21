<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\KeyboardButton;

class KeyboardButtonTest extends TestCase {

    public function testAccessors() {

        $obj = new KeyboardButton();

        $obj->setText('text');
        $obj->setRequestContact(1);
        $obj->setRequestLocation(2);

        $this->assertEquals('text', $obj->getText());
        $this->assertEquals(1, $obj->getRequestContact());
        $this->assertEquals(2, $obj->getRequestLocation());

        $this->assertJson(json_encode($obj));
    }
}
