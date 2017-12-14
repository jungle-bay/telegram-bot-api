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
use TelegramBotAPI\Types\ForceReply;

/**
 * Class ForceReplyTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ForceReplyTest extends TestCase {

    public function testAccessors() {

        $obj = new ForceReply();

        $obj->setForceReply(false);
        $obj->setSelective(true);

        $this->assertFalse($obj->isForceReply());
        $this->assertTrue($obj->isSelective());

        $this->assertJson(json_encode($obj));
    }
}
