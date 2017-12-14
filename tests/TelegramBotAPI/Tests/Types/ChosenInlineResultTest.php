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
use TelegramBotAPI\Types\Location;
use TelegramBotAPI\Types\ChosenInlineResult;

/**
 * Class ChosenInlineResultTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ChosenInlineResultTest extends TestCase {

    public function testAccessors() {

        $obj = new ChosenInlineResult();

        $obj->setFrom(new User());
        $obj->setInlineMessageId('inline_message_id');
        $obj->setLocation(new Location());
        $obj->setQuery('query');
        $obj->setResultId('result_id');

        $this->assertInstanceOf(User::class, $obj->getFrom());
        $this->assertEquals('inline_message_id', $obj->getInlineMessageId());
        $this->assertInstanceOf(Location::class, $obj->getLocation());
        $this->assertEquals('query', $obj->getQuery());
        $this->assertEquals('result_id', $obj->getResultId());

        $this->assertJson(json_encode($obj));
    }
}
