<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultMpeg4Gif;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

/**
 * Class InlineQueryResultMpeg4GifTest
 * @package TelegramBotAPI\Tests\InlineQueryResult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultMpeg4GifTest extends TestCase {

    /**
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testAccessors() {

        $obj = new InlineQueryResultMpeg4Gif();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setMpeg4Url('Mpeg4Url');
        $obj->setMpeg4Duration(3);
        $obj->setMpeg4Width(1);
        $obj->setMpeg4Height(2);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('mpeg4_gif', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('Mpeg4Url', $obj->getMpeg4Url());
        $this->assertEquals(3, $obj->getMpeg4Duration());
        $this->assertEquals(1, $obj->getMpeg4Width());
        $this->assertEquals(2, $obj->getMpeg4Height());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
