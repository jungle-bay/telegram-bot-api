<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InputLocationMessageContentTest extends TestCase {

    public function testAccessors() {

        $init = array(1, 2, 10);
        $setter = array(3, 5, 20);

        $obj = new InputLocationMessageContent(array(
            'latitude'    => $init[0],
            'longitude'   => $init[1],
            'live_period' => $init[2]
        ));

        $this->assertEquals($init[0], $obj->getLatitude());
        $this->assertEquals($init[1], $obj->getLongitude());
        $this->assertEquals($init[2], $obj->getLivePeriod());

        $obj->setLatitude($setter[0]);
        $obj->setLongitude($setter[1]);
        $obj->setLivePeriod($setter[2]);

        $this->assertEquals($setter[0], $obj->getLatitude());
        $this->assertEquals($setter[1], $obj->getLongitude());
        $this->assertEquals($setter[2], $obj->getLivePeriod());

        $this->assertJson(json_encode($obj));
    }
}
