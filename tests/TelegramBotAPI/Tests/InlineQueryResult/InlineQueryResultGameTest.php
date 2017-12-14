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
use TelegramBotAPI\InlineQueryResult\InlineQueryResultGame;

/**
 * Class InlineQueryResultGameTest
 * @package TelegramBotAPI\Tests\InlineQueryResult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
