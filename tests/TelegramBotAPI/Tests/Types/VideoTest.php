<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\TelegramBotAPIConstants;
use TelegramBotAPI\Types\Video;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\PhotoSize;

class VideoTest extends TestCase {

    public function testAccessors() {

        $obj = new Video();

        $obj->setFileId('file_id');
        $obj->setFileSize(123);
        $obj->setThumb(new PhotoSize());
        $obj->setWidth(1);
        $obj->setHeight(2);
        $obj->setMimeType(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE);
        $obj->setDuration(3);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123, $obj->getFileSize());
        $this->assertInstanceOf(PhotoSize::class, $obj->getThumb());
        $this->assertEquals(1, $obj->getWidth());
        $this->assertEquals(2, $obj->getHeight());
        $this->assertEquals(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());
        $this->assertEquals(3, $obj->getDuration());

        $this->assertJson(json_encode($obj));
    }
}
