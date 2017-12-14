<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InputMessageContent\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultAudio;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

/**
 * Class InlineQueryResultAudioTest
 * @package TelegramBotAPI\Tests\InlineQueryResult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultAudioTest extends TestCase {

    /**
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testAccessors() {

        $obj = new InlineQueryResultAudio();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setCaption('url');
        $obj->setPerformer('performer');
        $obj->setAudioUrl('audio_url');
        $obj->setAudioDuration(1);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('audio', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('url', $obj->getCaption());
        $this->assertEquals('performer', $obj->getPerformer());
        $this->assertEquals('audio_url', $obj->getAudioUrl());
        $this->assertEquals(1, $obj->getAudioDuration());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
