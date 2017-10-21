<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ChatPhoto;

class ChatPhotoTest extends TestCase {

    public function testAccessors() {

        $obj = new ChatPhoto();

        $obj->setBigFileId('big_file_id');
        $obj->setSmallFileId('small_file_id');

        $this->assertEquals('big_file_id', $obj->getBigFileId());
        $this->assertEquals('small_file_id', $obj->getSmallFileId());

        $this->assertJson(json_encode($obj));
    }
}
