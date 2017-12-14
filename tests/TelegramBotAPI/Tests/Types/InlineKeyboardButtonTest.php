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


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\CallbackGame;
use TelegramBotAPI\Types\InlineKeyboardButton;

/**
 * Class InlineKeyboardButtonTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineKeyboardButtonTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineKeyboardButton();

        $obj->setText('text');
        $obj->setUrl('url');
        $obj->setCallbackData('callback_data');
        $obj->setCallbackGame(new CallbackGame());
        $obj->setPay(true);
        $obj->setSwitchInlineQuery('switch_inline_query');
        $obj->setSwitchInlineQueryCurrentChat('switch_inline_query_current_chat');

        $this->assertEquals('text', $obj->getText());
        $this->assertEquals('url', $obj->getUrl());
        $this->assertEquals('callback_data', $obj->getCallbackData());
        $this->assertInstanceOf(CallbackGame::class, $obj->getCallbackGame());
        $this->assertTrue($obj->isPay());
        $this->assertEquals('switch_inline_query', $obj->getSwitchInlineQuery());
        $this->assertEquals('switch_inline_query_current_chat', $obj->getSwitchInlineQueryCurrentChat());

        $this->assertJson(json_encode($obj));
    }
}
