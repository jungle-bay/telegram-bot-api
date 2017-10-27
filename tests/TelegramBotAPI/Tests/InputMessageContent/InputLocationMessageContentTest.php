<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputLocationMessageContent;

class InputLocationMessageContentTest extends TestCase {

    private function gettersTest(InputLocationMessageContent $obj) {

        $this->assertEquals(1.1, $obj->getLatitude());
        $this->assertEquals(2.2, $obj->getLongitude());
        $this->assertEquals(10, $obj->getLivePeriod());
    }


    public function testJsonToObj() {

        $obj = new InputLocationMessageContent(array(
            'latitude'    => 1.1,
            'longitude'   => 2.2,
            'live_period' => 10
        ));

        $this->gettersTest($obj);

        return $obj;
    }

    public function testSetters() {

        $obj = new InputLocationMessageContent();

        $obj->setLatitude(1.1);
        $obj->setLongitude(2.2);
        $obj->setLivePeriod(10);

        $this->gettersTest($obj);
    }

    /**
     * @param InputLocationMessageContent $obj
     *
     * @depends testJsonToObj
     */
    public function testObjToJson(InputLocationMessageContent $obj) {

        $json = json_encode($obj);
        $obj = json_decode($json, true);

        $this->assertJson($json);
        $this->assertArrayHasKey('latitude', $obj);
        $this->assertArrayHasKey('longitude', $obj);
        $this->assertArrayHasKey('live_period', $obj);
    }
}
