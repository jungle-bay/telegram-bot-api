<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\CallbackQuery;

/**
 * Class CallbackQueryTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class CallbackQueryTest extends TestCase {

    public function testAccessors() {

        $obj = new CallbackQuery();

        $obj->setId('id');
        $obj->setFrom(new User());
        $obj->setData('12 12 2012');
        $obj->setMessage(new Message());
        $obj->setChatInstance('chat_instance');
        $obj->setGameShortName('game_short_name');
        $obj->setInlineMessageId('inline_message_id');

        $this->assertEquals('id', $obj->getId());
        $this->assertInstanceOf(User::class, $obj->getFrom());
        $this->assertEquals('12 12 2012', $obj->getData());
        $this->assertInstanceOf(Message::class, $obj->getMessage());
        $this->assertEquals('chat_instance', $obj->getChatInstance());
        $this->assertEquals('game_short_name', $obj->getGameShortName());
        $this->assertEquals('inline_message_id', $obj->getInlineMessageId());

        $this->assertJson(json_encode($obj));
    }
}
