<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase {

    public function testAccessors() {

        $obj = new File();

        $obj->setFileId('file_id');
        $obj->setFileSize(123456);
        $obj->setFilePath('file_path');

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123456, $obj->getFileSize());
        $this->assertEquals('file_path', $obj->getFilePath());

        $this->assertJson(json_encode($obj));
    }
}
