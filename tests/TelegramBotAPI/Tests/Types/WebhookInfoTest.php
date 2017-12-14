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
use TelegramBotAPI\Types\WebhookInfo;

/**
 * Class WebhookInfoTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class WebhookInfoTest extends TestCase {

    public function testAccessors() {

        $obj = new WebhookInfo();

        $obj->setUrl('url');
        $obj->setAllowedUpdates(array());
        $obj->setHasCustomCertificate(true);
        $obj->setLastErrorDate(1);
        $obj->setLastErrorMessage('last_error_message');
        $obj->setMaxConnections(2);
        $obj->setPendingUpdateCount(3);

        $this->assertEquals('url', $obj->getUrl());
        $this->assertEquals('array', gettype($obj->getAllowedUpdates()));
        $this->assertTrue($obj->isHasCustomCertificate());
        $this->assertEquals(1, $obj->getLastErrorDate());
        $this->assertEquals('last_error_message', $obj->getLastErrorMessage());
        $this->assertEquals(2, $obj->getMaxConnections());
        $this->assertEquals(3, $obj->getPendingUpdateCount());

        $this->assertJson(json_encode($obj));
    }
}
