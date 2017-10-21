<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ReplyKeyboardRemove;

class ReplyKeyboardRemoveTest extends TestCase {

    public function testAccessors() {

        $obj = new ReplyKeyboardRemove();

        $obj->setSelective(true);
        $obj->setRemoveKeyboard(false);

        $this->assertTrue($obj->getSelective());
        $this->assertFalse($obj->getRemoveKeyboard());

        $this->assertJson(json_encode($obj));
    }
}
