<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultCachedSticker;

class InlineQueryResultCachedStickerTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultCachedSticker();

        $obj->setId('id');
        $obj->setStickerFileId('sticker_file_id');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('sticker', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('sticker_file_id', $obj->getStickerFileId());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
