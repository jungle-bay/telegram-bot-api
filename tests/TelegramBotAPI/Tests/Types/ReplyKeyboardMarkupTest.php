<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ReplyKeyboardMarkup;

class ReplyKeyboardMarkupTest extends TestCase {

    public function testAccessors() {

        $obj = new ReplyKeyboardMarkup();

        $obj->setSelective(true);
        $obj->setKeyboard(array());
        $obj->setOneTimeKeyboard(true);
        $obj->setResizeKeyboard(true);

        $this->assertTrue($obj->getSelective());
        $this->assertEquals('array', gettype($obj->getKeyboard()));
        $this->assertTrue($obj->getOneTimeKeyboard());
        $this->assertTrue($obj->getResizeKeyboard());

        $this->assertJson(json_encode($obj));
    }
}
