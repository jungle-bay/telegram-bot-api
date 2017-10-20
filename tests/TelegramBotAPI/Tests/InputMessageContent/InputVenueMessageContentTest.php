<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputVenueMessageContent;

class InputVenueMessageContentTest extends TestCase {

    public function testAccessors() {

        $init = array(1.1, 2.2, 'address', 'title', 'foursquare_id');
        $setter = array(2.2, 1.1, 'address', 'title', 'foursquare_id');

        $obj = new InputVenueMessageContent(array(
            'latitude'      => $init[0],
            'longitude'     => $init[1],
            'address'       => $init[2],
            'title'         => $init[3],
            'foursquare_id' => $init[4]
        ));

        $this->assertEquals($init[0], $obj->getLatitude());
        $this->assertEquals($init[1], $obj->getLongitude());
        $this->assertEquals($init[2], $obj->getAddress());
        $this->assertEquals($init[3], $obj->getTitle());
        $this->assertEquals($init[4], $obj->getFoursquareId());

        $obj->setLatitude($setter[0]);
        $obj->setLongitude($setter[1]);
        $obj->setAddress($setter[2]);
        $obj->setTitle($setter[3]);
        $obj->setFoursquareId($setter[4]);

        $this->assertEquals($setter[0], $obj->getLatitude());
        $this->assertEquals($setter[1], $obj->getLongitude());
        $this->assertEquals($setter[2], $obj->getAddress());
        $this->assertEquals($setter[3], $obj->getTitle());
        $this->assertEquals($setter[4], $obj->getFoursquareId());

        $this->assertJson(json_encode($obj));
    }
}
