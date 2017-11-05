<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultPhoto;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultPhotoTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultPhoto();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setPhotoUrl('PhotoUrl');
        $obj->setThumbUrl('thumb_url');
        $obj->setDescription('description');
        $obj->setPhotoWidth(1);
        $obj->setPhotoHeight(2);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('photo', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('PhotoUrl', $obj->getPhotoUrl());
        $this->assertEquals('thumb_url', $obj->getThumbUrl());
        $this->assertEquals('description', $obj->getDescription());
        $this->assertEquals(1, $obj->getPhotoWidth());
        $this->assertEquals(2, $obj->getPhotoHeight());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
