<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\CallbackGame;

class CallbackGameTest extends TestCase {

    public function testAccessors() {

        $obj = new CallbackGame();

        $this->assertJson(json_encode($obj));
    }
}
