<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Animation;
use TelegramBotAPI\Types\PhotoSize;

class AnimationTest extends TestCase {

    public function testAccessors() {

        $obj = new Animation();

        $obj->setFileId('FileId');
        $obj->setFileName('FileName');
        $obj->setThumb(new PhotoSize());
        $obj->setMimeType(Constants::APPLICATION_ZIP_MIME_TYPE);
        $obj->setFileSize(123);

        $this->assertEquals('FileId', $obj->getFileId());
        $this->assertEquals('FileName', $obj->getFileName());
        $this->assertInstanceOf(PhotoSize::class, $obj->getThumb());
        $this->assertEquals(Constants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());
        $this->assertEquals(123, $obj->getFileSize());

        $this->assertJson(json_encode($obj));
    }
}
