<?php

namespace TelegramBotAPI\Tests\Types;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\WebhookInfo;

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
        $this->assertTrue($obj->getHasCustomCertificate());
        $this->assertEquals(1, $obj->getLastErrorDate());
        $this->assertEquals('last_error_message', $obj->getLastErrorMessage());
        $this->assertEquals(2, $obj->getMaxConnections());
        $this->assertEquals(3, $obj->getPendingUpdateCount());

        $this->assertJson(json_encode($obj));
    }
}
