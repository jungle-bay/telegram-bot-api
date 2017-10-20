<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultArticle;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultArticleTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultArticle();

        $obj->setId('id');
        $obj->setUrl('url');
        $obj->setTitle('title');
        $obj->setHideUrl('hide_url');
        $obj->setThumbUrl('thumb_url');
        $obj->setThumbWidth(1);
        $obj->setThumbHeight(2);
        $obj->setDescription('description');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('article', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('url', $obj->getUrl());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('hide_url', $obj->getHideUrl());
        $this->assertEquals('thumb_url', $obj->getThumbUrl());
        $this->assertEquals(1, $obj->getThumbWidth());
        $this->assertEquals(2, $obj->getThumbHeight());
        $this->assertEquals('description', $obj->getDescription());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
