<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultVoice;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultVoiceTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultVoice();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setVoiceDuration(3);
        $obj->setCaption('caption');
        $obj->setVoiceUrl('voice_url');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('voice', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals(3, $obj->getVoiceDuration());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('voice_url', $obj->getVoiceUrl());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
