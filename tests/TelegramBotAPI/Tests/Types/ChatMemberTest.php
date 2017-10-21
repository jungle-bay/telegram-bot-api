<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ChatMember;

class ChatMemberTest extends TestCase {

    public function testAccessors() {

        $obj = new ChatMember();

        $obj->setUser(new User());
        $obj->setStatus('status');
        $obj->setUntilDate(123456);
        $obj->setCanBeEdited(true);
        $obj->setCanChangeInfo(true);
        $obj->setCanInviteUsers(true);
        $obj->setCanPinMessages(true);
        $obj->setCanPostMessages(true);
        $obj->setCanEditMessages(true);
        $obj->setCanSendMessages(true);
        $obj->setCanPromoteMembers(true);
        $obj->setCanDeleteMessages(true);
        $obj->setCanRestrictMembers(true);
        $obj->setCanSendMediaMessages(true);
        $obj->setCanSendOtherMessages(true);
        $obj->setCanAddWebPagePreviews(true);

        $this->assertInstanceOf(User::class, $obj->getUser());
        $this->assertEquals('status', $obj->getStatus());
        $this->assertEquals(123456, $obj->getUntilDate());
        $this->assertTrue($obj->getCanBeEdited());
        $this->assertTrue($obj->getCanChangeInfo());
        $this->assertTrue($obj->getCanInviteUsers());
        $this->assertTrue($obj->getCanPinMessages());
        $this->assertTrue($obj->getCanPostMessages());
        $this->assertTrue($obj->getCanEditMessages());
        $this->assertTrue($obj->getCanSendMessages());
        $this->assertTrue($obj->getCanPromoteMembers());
        $this->assertTrue($obj->getCanDeleteMessages());
        $this->assertTrue($obj->getCanRestrictMembers());
        $this->assertTrue($obj->getCanSendMediaMessages());
        $this->assertTrue($obj->getCanSendOtherMessages());
        $this->assertTrue($obj->getCanAddWebPagePreviews());

        $this->assertJson(json_encode($obj));
    }
}
