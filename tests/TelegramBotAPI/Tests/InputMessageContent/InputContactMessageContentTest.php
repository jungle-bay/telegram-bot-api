<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\InputMessageContent;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputContactMessageContent;

/**
 * Class InputContactMessageContentTest
 * @package TelegramBotAPI\Tests\InputMessageContent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputContactMessageContentTest extends TestCase {

    private function gettersTest(InputContactMessageContent $obj) {

        $this->assertEquals('phone_number', $obj->getPhoneNumber());
        $this->assertEquals('first_name', $obj->getFirstName());
        $this->assertEquals('last_name', $obj->getLastName());
    }


    public function testJsonToObj() {

        $obj = new InputContactMessageContent(array(
            'phone_number' => 'phone_number',
            'first_name'   => 'first_name',
            'last_name'    => 'last_name'
        ));

        $this->gettersTest($obj);

        return $obj;
    }

    public function testSetters() {

        $obj = new InputContactMessageContent();

        $obj->setPhoneNumber('phone_number');
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');

        $this->gettersTest($obj);
    }

    /**
     * @param InputContactMessageContent $obj
     *
     * @depends testJsonToObj
     */
    public function testObjToJson(InputContactMessageContent $obj) {

        $json = json_encode($obj);
        $obj = json_decode($json, true);

        $this->assertJson($json);
        $this->assertArrayHasKey('phone_number', $obj);
        $this->assertArrayHasKey('first_name', $obj);
        $this->assertArrayHasKey('last_name', $obj);
    }
}
