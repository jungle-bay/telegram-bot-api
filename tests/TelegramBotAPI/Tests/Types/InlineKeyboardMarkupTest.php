<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;

class InlineKeyboardMarkupTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineKeyboardMarkup();

        $obj->setInlineKeyboard(array());

        $this->assertEquals('array', gettype($obj->getInlineKeyboard()));

        $this->assertJson(json_encode($obj));
    }
}
