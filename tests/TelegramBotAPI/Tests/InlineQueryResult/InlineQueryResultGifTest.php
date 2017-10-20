<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultGif;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultGifTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultGif();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setThumbUrl('thumb_url');
        $obj->setGifUrl('gif_url');
        $obj->setGifDuration(3);
        $obj->setGifHeight(2);
        $obj->setGifWidth(1);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('gif', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('thumb_url', $obj->getThumbUrl());
        $this->assertEquals('gif_url', $obj->getGifUrl());
        $this->assertEquals(3, $obj->getGifDuration());
        $this->assertEquals(1, $obj->getGifWidth());
        $this->assertEquals(2, $obj->getGifHeight());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
