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
use TelegramBotAPI\Types\StickerSet;

/**
 * Class StickerSetTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class StickerSetTest extends TestCase {

    public function testAccessors() {

        $obj = new StickerSet();

        $obj->setName('name');
        $obj->setTitle('title');
        $obj->setContainsMasks(true);
        $obj->setStickers(array());

        $this->assertEquals('name', $obj->getName());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertTrue($obj->isContainsMasks());
        $this->assertEquals('array', gettype($obj->getStickers()));

        $this->assertJson(json_encode($obj));
    }
}
