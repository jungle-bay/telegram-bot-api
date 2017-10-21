<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ForceReply;

class ForceReplyTest extends TestCase {

    public function testAccessors() {

        $obj = new ForceReply();

        $obj->setForceReply(false);
        $obj->setSelective(true);

        $this->assertFalse($obj->getForceReply());
        $this->assertTrue($obj->getSelective());

        $this->assertJson(json_encode($obj));
    }
}
