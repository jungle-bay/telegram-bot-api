<?php

namespace TelegramBotAPI\Tests\InlineQueryResult;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultGame;

class InlineQueryResultGameTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultGame();

        $obj->setId('id');
        $obj->setGameShortName('name');
        $obj->setReplyMarkup(new InlineKeyboardMarkup());

        $this->assertEquals('game', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('name', $obj->getGameShortName());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());

        $this->assertJson(json_encode($obj));
    }
}
