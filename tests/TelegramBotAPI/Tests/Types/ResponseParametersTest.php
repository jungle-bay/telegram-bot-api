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
use TelegramBotAPI\Types\ResponseParameters;

/**
 * Class ResponseParametersTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ResponseParametersTest extends TestCase {

    public function testAccessors() {

        $obj = new ResponseParameters();

        $obj->setRetryAfter(1);
        $obj->setMigrateToChatId(2);

        $this->assertEquals(1, $obj->getRetryAfter());
        $this->assertEquals(2, $obj->getMigrateToChatId());

        $this->assertJson(json_encode($obj));
    }
}
