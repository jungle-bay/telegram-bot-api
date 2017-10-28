<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\TelegramBotAPIConstants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InputFile;

class InputFileTest extends TestCase {

    public function testAccessors() {

        $obj = new InputFile('');

        $obj->setPostFilename('file_name');
        $obj->setMimeType(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE);

        $this->assertEquals('file_name', $obj->getPostFilename());
        $this->assertEquals(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());

        $this->assertJson(json_encode($obj));
    }
}
