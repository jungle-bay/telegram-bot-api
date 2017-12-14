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
use TelegramBotAPI\Types\UserProfilePhotos;

/**
 * Class UserProfilePhotosTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class UserProfilePhotosTest extends TestCase {

    public function testAccessors() {

        $obj = new UserProfilePhotos();

        $obj->setPhotos(array());
        $obj->setTotalCount(1);

        $this->assertEquals(1, $obj->getTotalCount());

        $this->assertJson(json_encode($obj));
    }
}
