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
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\InlineQuery;
use TelegramBotAPI\Types\CallbackQuery;
use TelegramBotAPI\Types\ShippingQuery;
use TelegramBotAPI\Types\PreCheckoutQuery;
use TelegramBotAPI\Types\ChosenInlineResult;

/**
 * Class UpdateTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class UpdateTest extends TestCase {

    public function testAccessors() {

        $obj = new Update();

        $obj->setUpdateId(123456);
        $obj->setMessage(new Message());
        $obj->setCallbackQuery(new CallbackQuery());
        $obj->setChannelPost(new Message());
        $obj->setChosenInlineResult(new ChosenInlineResult());
        $obj->setEditedChannelPost(new Message());
        $obj->setEditedMessage(new Message());
        $obj->setInlineQuery(new InlineQuery());
        $obj->setPreCheckoutQuery(new PreCheckoutQuery());
        $obj->setShippingQuery(new ShippingQuery());

        $this->assertEquals(123456, $obj->getUpdateId());
        $this->assertInstanceOf(Message::class, $obj->getMessage());
        $this->assertInstanceOf(CallbackQuery::class, $obj->getCallbackQuery());
        $this->assertInstanceOf(Message::class, $obj->getChannelPost());
        $this->assertInstanceOf(ChosenInlineResult::class, $obj->getChosenInlineResult());
        $this->assertInstanceOf(Message::class, $obj->getEditedChannelPost());
        $this->assertInstanceOf(Message::class, $obj->getEditedMessage());
        $this->assertInstanceOf(InlineQuery::class, $obj->getInlineQuery());
        $this->assertInstanceOf(PreCheckoutQuery::class, $obj->getPreCheckoutQuery());
        $this->assertInstanceOf(ShippingQuery::class, $obj->getShippingQuery());

        $this->assertJson(json_encode($obj));
    }
}
