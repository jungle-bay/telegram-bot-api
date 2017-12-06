<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Constants;
use TelegramBotAPI\Types\Audio;
use PHPUnit\Framework\TestCase;

class AudioTest extends TestCase {

    public function testAccessors() {

        $obj = new Audio();

        $obj->setFileId('file_id');
        $obj->setFileSize(123);
        $obj->setTitle('title');
        $obj->setPerformer('performer');
        $obj->setDuration(1);
        $obj->setMimeType(Constants::APPLICATION_ZIP_MIME_TYPE);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123, $obj->getFileSize());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('performer', $obj->getPerformer());
        $this->assertEquals(1, $obj->getDuration());
        $this->assertEquals(Constants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());

        $this->assertJson(json_encode($obj));
    }
}
