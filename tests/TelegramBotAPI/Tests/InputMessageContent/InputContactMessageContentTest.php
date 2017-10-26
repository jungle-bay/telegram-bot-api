<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputContactMessageContent;

class InputContactMessageContentTest extends TestCase {

    private function gettersAssert(InputContactMessageContent $obj) {

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

        $this->gettersAssert($obj);

        return $obj;
    }

    public function testSetters() {

        $obj = new InputContactMessageContent();

        $obj->setPhoneNumber('phone_number');
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');

        $this->gettersAssert($obj);
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
