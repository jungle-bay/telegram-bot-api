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
use TelegramBotAPI\Types\Contact;

/**
 * Class ContactTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ContactTest extends TestCase {

    public function testAccessors() {

        $obj = new Contact();

        $obj->setUserId(123456);
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');
        $obj->setPhoneNumber('phone_number');

        $this->assertEquals(123456, $obj->getUserId());
        $this->assertEquals('first_name', $obj->getFirstName());
        $this->assertEquals('last_name', $obj->getLastName());
        $this->assertEquals('phone_number', $obj->getPhoneNumber());

        $this->assertJson(json_encode($obj));
    }
}
