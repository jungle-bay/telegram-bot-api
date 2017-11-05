<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\TelegramBotAPIConstants;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultDocument;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InlineQueryResultDocumentTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultDocument();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('caption');
        $obj->setDescription('description');
        $obj->setThumbUrl('thumb_url');
        $obj->setThumbWidth(1);
        $obj->setThumbHeight(2);
        $obj->setDocumentUrl('document_url');
        $obj->setMimeType(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE);

        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('document', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertEquals('description', $obj->getDescription());
        $this->assertEquals('thumb_url', $obj->getThumbUrl());
        $this->assertEquals(1, $obj->getThumbWidth());
        $this->assertEquals(2, $obj->getThumbHeight());
        $this->assertEquals('document_url', $obj->getDocumentUrl());
        $this->assertEquals(TelegramBotAPIConstants::APPLICATION_ZIP_MIME_TYPE, $obj->getMimeType());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
