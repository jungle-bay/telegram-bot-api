<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultCachedGif;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultCachedGifTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultCachedGif();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setGifFileId('gif_file_id');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('gif', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('gif_file_id', $obj->getGifFileId());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
