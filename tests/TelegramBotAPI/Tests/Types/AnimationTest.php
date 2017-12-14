<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Animation;
use TelegramBotAPI\Types\PhotoSize;

/**
 * Class AnimationTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
