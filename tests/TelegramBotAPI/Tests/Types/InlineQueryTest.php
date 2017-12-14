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
use TelegramBotAPI\Types\InlineQuery;

/**
 * Class InlineQueryTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryTest extends TestCase {

    public function testAccessors() {

        $obj = new InlineQuery();

        $obj->setId('id');
        $obj->setQuery('query');
        $obj->setLocation(new Location());
        $obj->setFrom(new User());
        $obj->setOffset('offset');

        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('query', $obj->getQuery());
        $this->assertInstanceOf(Location::class, $obj->getLocation());
        $this->assertInstanceOf(User::class, $obj->getFrom());
        $this->assertEquals('offset', $obj->getOffset());

        $this->assertJson(json_encode($obj));
    }
}
