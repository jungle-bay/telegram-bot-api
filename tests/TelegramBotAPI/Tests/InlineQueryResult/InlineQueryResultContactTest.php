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
use TelegramBotAPI\InlineQueryResult\InlineQueryResultContact;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

/**
 * Class InlineQueryResultContactTest
 * @package TelegramBotAPI\Tests\InlineQueryResult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultContactTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQueryResultContact();

        $obj->setId('id');
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');
        $obj->setPhoneNumber('phone_number');
        $obj->setThumbUrl('thumb_url');
        $obj->setThumbWidth(1);
        $obj->setThumbHeight(2);
        $obj->setReplyMarkup(new InlineKeyboardMarkup());
        $obj->setInputMessageContent(new InputLocationMessageContent());

        $this->assertEquals('contact', $obj->getType());
        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('first_name', $obj->getFirstName());
        $this->assertEquals('last_name', $obj->getLastName());
        $this->assertEquals('phone_number', $obj->getPhoneNumber());
        $this->assertEquals(1, $obj->getThumbWidth());
        $this->assertEquals(2, $obj->getThumbHeight());

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $obj->getReplyMarkup());
        $this->assertInstanceOf(InputMessageContent::class, $obj->getInputMessageContent());

        $this->assertJson(json_encode($obj));
    }
}
