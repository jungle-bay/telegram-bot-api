<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Sticker;
use TelegramBotAPI\Types\PhotoSize;
use TelegramBotAPI\Types\MaskPosition;

class StickerTest extends TestCase {

    public function testAccessors() {

        $obj = new Sticker();

        $obj->setWidth(1);
        $obj->setHeight(2);
        $obj->setFileSize(3);
        $obj->setFileId('file_id');
        $obj->setThumb(new PhotoSize());
        $obj->setEmoji('emoji');
        $obj->setMaskPosition(new MaskPosition());
        $obj->setSetName('set_name');

        $this->assertEquals(1, $obj->getWidth());
        $this->assertEquals(2, $obj->getHeight());
        $this->assertEquals(3, $obj->getFileSize());
        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertInstanceOf(PhotoSize::class, $obj->getThumb());
        $this->assertEquals('emoji', $obj->getEmoji());
        $this->assertInstanceOf(MaskPosition::class, $obj->getMaskPosition());
        $this->assertEquals('set_name', $obj->getSetName());

        $this->assertJson(json_encode($obj));
    }
}
