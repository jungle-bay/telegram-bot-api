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


use TelegramBotAPI\Types\Game;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Animation;

/**
 * Class GameTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
        $this->assertEquals('array', gettype($obj->getPhoto()));
        $this->assertInstanceOf(Animation::class, $obj->getAnimation());
        $this->assertEquals('description', $obj->getDescription());
        $this->assertEquals('array', gettype($obj->getTextEntities()));

        $this->assertJson(json_encode($obj));
    }
}
