<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultCachedMpeg4Gif;

class InlineQueryResultCachedMpeg4GifTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultCachedMpeg4Gif();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setMpeg4FileId('mpeg4_file_id');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('mpeg4_gif', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('mpeg4_file_id', $obj->getMpeg4FileId());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
