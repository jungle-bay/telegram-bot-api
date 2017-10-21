<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\GameHighScore;

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
