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
use TelegramBotAPI\InputMessageContent\InputVenueMessageContent;

/**
 * Class InputVenueMessageContentTest
 * @package TelegramBotAPI\Tests\InputMessageContent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputVenueMessageContentTest extends TestCase {

    private function gettersTest(InputVenueMessageContent $obj) {

        $this->assertEquals(1.1, $obj->getLatitude());
        $this->assertEquals(2.2, $obj->getLongitude());
        $this->assertEquals('address', $obj->getAddress());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('foursquare_id', $obj->getFoursquareId());
    }


    public function testJsonToObj() {

        $obj = new InputVenueMessageContent(array(
            'latitude'      => 1.1,
            'longitude'     => 2.2,
            'address'       => 'address',
            'title'         => 'title',
            'foursquare_id' => 'foursquare_id'
        ));

        $this->gettersTest($obj);

        return $obj;
    }

    public function testSetters() {

        $obj = new InputVenueMessageContent();

        $obj->setLatitude(1.1);
        $obj->setLongitude(2.2);
        $obj->setAddress('address');
        $obj->setTitle('title');
        $obj->setFoursquareId('foursquare_id');

        $this->gettersTest($obj);
    }

    /**
     * @param InputVenueMessageContent $obj
     *
     * @depends testJsonToObj
     */
    public function testObjToJson(InputVenueMessageContent $obj) {

        $json = json_encode($obj);
        $obj = json_decode($json, true);

        $this->assertJson($json);
        $this->assertArrayHasKey('latitude', $obj);
        $this->assertArrayHasKey('longitude', $obj);
        $this->assertArrayHasKey('address', $obj);
        $this->assertArrayHasKey('title', $obj);
        $this->assertArrayHasKey('foursquare_id', $obj);
    }
}
