<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultCachedAudio;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultCachedAudioTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultCachedAudio();

        $obj->setId('id');
        $obj->setCaption('caption');
        $obj->setAudioFileId('audio_file_id');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('audio', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('audio_file_id', $obj->getAudioFileId());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
