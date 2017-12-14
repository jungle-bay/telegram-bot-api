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
use TelegramBotAPI\Types\ChatPhoto;

/**
 * Class ChatPhotoTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChatPhotoTest extends TestCase {

    public function testAccessors() {

        $obj = new ChatPhoto();

        $obj->setBigFileId('big_file_id');
        $obj->setSmallFileId('small_file_id');

        $this->assertEquals('big_file_id', $obj->getBigFileId());
        $this->assertEquals('small_file_id', $obj->getSmallFileId());

        $this->assertJson(json_encode($obj));
    }
}
