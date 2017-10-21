<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\UserProfilePhotos;

class UserProfilePhotosTest extends TestCase {

    public function testAccessors() {

        $obj = new UserProfilePhotos();

        $obj->setPhotos(array());
        $obj->setTotalCount(1);

        $this->assertEquals(1, $obj->getTotalCount());

        $this->assertJson(json_encode($obj));
    }
}
