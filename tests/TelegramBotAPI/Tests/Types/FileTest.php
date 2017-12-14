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


use TelegramBotAPI\Types\File;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
