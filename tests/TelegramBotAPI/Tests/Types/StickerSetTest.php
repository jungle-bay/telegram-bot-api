<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\StickerSet;

class StickerSetTest extends TestCase {

    public function testAccessors() {

        $obj = new StickerSet();

        $obj->setName('name');
        $obj->setTitle('title');
        $obj->setContainsMasks(true);
        $obj->setStickers(array());

        $this->assertEquals('name', $obj->getName());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertTrue($obj->getContainsMasks());
        $this->assertEquals('array', gettype($obj->getStickers()));

        $this->assertJson(json_encode($obj));
    }
}
