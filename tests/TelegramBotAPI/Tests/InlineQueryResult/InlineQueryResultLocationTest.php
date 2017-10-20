<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultLocation;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultLocationTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultLocation();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setThumbUrl('thumb_url');
        $obj->setThumbWidth(1);
        $obj->setThumbHeight(2);
        $obj->setLatitude(1.1);
        $obj->setLongitude(2.2);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('location', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('thumb_url', $obj->getThumbUrl());
        $this->assertEquals(1, $obj->getThumbWidth());
        $this->assertEquals(2, $obj->getThumbHeight());
        $this->assertEquals(1.1, $obj->getLatitude());
        $this->assertEquals(2.2, $obj->getLongitude());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
