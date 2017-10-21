<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ResponseParameters;

class ResponseParametersTest extends TestCase {

    public function testAccessors() {

        $obj = new ResponseParameters();

        $obj->setRetryAfter(1);
        $obj->setMigrateToChatId(2);

        $this->assertEquals(1, $obj->getRetryAfter());
        $this->assertEquals(2, $obj->getMigrateToChatId());

        $this->assertJson(json_encode($obj));
    }
}
