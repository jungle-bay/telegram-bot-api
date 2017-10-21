<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Document;
use TelegramBotAPI\Types\PhotoSize;

class DocumentTest extends TestCase {

    public function testAccessors() {

        $obj = new Document();

        $obj->setFileId('file_id');
        $obj->setFileName('file_name');
        $obj->setThumb(new PhotoSize());
        $obj->setFileSize(123456);
        $obj->setMimeType(Constants::APPLICATION_ZIP_MIME_TYPE);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals('file_name', $obj->getFileName());
        $this->assertInstanceOf(PhotoSize::class, $obj->getThumb());
        $this->assertEquals(123456, $obj->getFileSize());
        $this->assertEquals(Constants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());

        $this->assertJson(json_encode($obj));
    }
}
