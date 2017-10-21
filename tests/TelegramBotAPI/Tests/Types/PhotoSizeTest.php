<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\PhotoSize;

class PhotoSizeTest extends TestCase {

    public function testAccessors() {

        $obj = new PhotoSize();

        $obj->setFileId('file_id');
        $obj->setFileSize(123);
        $obj->setWidth(1);
        $obj->setHeight(2);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123, $obj->getFileSize());
        $this->assertEquals(1, $obj->getWidth());
        $this->assertEquals(2, $obj->getHeight());

        $this->assertJson(json_encode($obj));
    }
}
