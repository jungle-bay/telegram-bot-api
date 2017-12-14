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
use TelegramBotAPI\Types\VideoNote;

/**
 * Class VideoNoteTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
