<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputContactMessageContent;

class InputContactMessageContentTest extends TestCase {

    public function testAccessors() {

        $init = array('first_name', 'last_name', 'phone_number');
        $setter = array('phone_number', 'last_name', 'first_name');

        $obj = new InputContactMessageContent(array(
            'first_name'   => $init[0],
            'last_name'    => $init[1],
            'phone_number' => $init[2]
        ));

        $this->assertEquals($init[0], $obj->getFirstName());
        $this->assertEquals($init[1], $obj->getLastName());
        $this->assertEquals($init[2], $obj->getPhoneNumber());

        $obj->setFirstName($setter[0]);
        $obj->setLastName($setter[1]);
        $obj->setPhoneNumber($setter[2]);

        $this->assertEquals($setter[0], $obj->getFirstName());
        $this->assertEquals($setter[1], $obj->getLastName());
        $this->assertEquals($setter[2], $obj->getPhoneNumber());

        $this->assertJson(json_encode($obj));
    }
}
