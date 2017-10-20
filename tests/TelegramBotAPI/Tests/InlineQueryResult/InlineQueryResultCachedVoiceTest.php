<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultCachedVoice;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultCachedVoiceTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultCachedVoice();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setVoiceFileId('voice_file_id');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('voice', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('voice_file_id', $obj->getVoiceFileId());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
