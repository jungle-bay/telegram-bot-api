<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Voice;

class VoiceTest extends TestCase {

    public function testAccessors() {

        $obj = new Voice();

        $obj->setFileId('file_id');
        $obj->setFileSize(123);
        $obj->setMimeType(Constants::APPLICATION_PDF_MIME_TYPE);
        $obj->setDuration(3);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123, $obj->getFileSize());
        $this->assertEquals(Constants::APPLICATION_PDF_MIME_TYPE, $obj->getMimeType());
        $this->assertEquals(3, $obj->getDuration());

        $this->assertJson(json_encode($obj));
    }
}
