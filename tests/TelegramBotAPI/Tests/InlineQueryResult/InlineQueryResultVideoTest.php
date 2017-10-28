<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use TelegramBotAPI\TelegramBotAPIConstants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultVideo;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultVideoTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultVideo();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setVideoDuration('video_duration');
        $obj->setVideoUrl('video_url');
        $obj->setVideoWidth(1);
        $obj->setVideoHeight(2);
        $obj->setThumbUrl('thumb_url');
        $obj->setDescription('description');
        $obj->setMimeType(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('video', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('video_duration', $obj->getVideoDuration());
        $this->assertEquals('video_url', $obj->getVideoUrl());
        $this->assertEquals(1, $obj->getVideoWidth());
        $this->assertEquals(2, $obj->getVideoHeight());
        $this->assertEquals('thumb_url', $obj->getThumbUrl());
        $this->assertEquals('description', $obj->getDescription());
        $this->assertEquals(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
