<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\PhotoSize;
use TelegramBotAPI\Types\VideoNote;

class VideoNoteTest extends TestCase {

    public function testAccessors() {

        $obj = new VideoNote();

        $obj->setFileId('file_id');
        $obj->setFileSize(123);
        $obj->setThumb(new PhotoSize());
        $obj->setDuration(3);
        $obj->setLength(321);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123, $obj->getFileSize());
        $this->assertInstanceOf(PhotoSize::class, $obj->getThumb());
        $this->assertEquals(3, $obj->getDuration());
        $this->assertEquals(321, $obj->getLength());

        $this->assertJson(json_encode($obj));
    }
}
