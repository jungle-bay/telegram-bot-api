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
use TelegramBotAPI\Types\GameHighScore;

/**
 * Class GameHighScoreTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class GameHighScoreTest extends TestCase {

    public function testAccessors() {

        $obj = new GameHighScore();

        $obj->setUser(new User());
        $obj->setPosition(123);
        $obj->setScore(321);

        $this->assertInstanceOf(User::class, $obj->getUser());
        $this->assertEquals(123, $obj->getPosition());
        $this->assertEquals(321, $obj->getScore());

        $this->assertJson(json_encode($obj));
    }
}
