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


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\PhotoSize;

/**
 * Class PhotoSizeTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class PhotoSizeTest extends TestCase {

    public function testAccessors() {

        $obj = new PhotoSize();

        $obj->setFileId('file_id');
        $obj->setFileSize(123);
        $obj->setWidth(1);
        $obj->setHeight(2);

        $this->assertEquals('file_id', $obj->getFileId());
        $this->assertEquals(123, $obj->getFileSize());
        $this->assertEquals(1, $obj->getWidth());
        $this->assertEquals(2, $obj->getHeight());

        $this->assertJson(json_encode($obj));
    }
}
