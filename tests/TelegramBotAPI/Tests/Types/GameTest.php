<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\Game;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Animation;

class GameTest extends TestCase {

    public function testAccessors() {

        $obj = new Game();

        $obj->setText('text');
        $obj->setTitle('title');
        $obj->setPhoto(array());
        $obj->setAnimation(new Animation());
        $obj->setDescription('description');
        $obj->setTextEntities(array());

        $this->assertEquals('text', $obj->getText());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertInstanceOf(Animation::class, $obj->getAnimation());
        $this->assertEquals('description', $obj->getDescription());

        $this->assertJson(json_encode($obj));
    }
}
