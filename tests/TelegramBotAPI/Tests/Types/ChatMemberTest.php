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


use TelegramBotAPI\Types\User;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\ChatMember;

/**
 * Class ChatMemberTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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
        $this->assertTrue($obj->isCanBeEdited());
        $this->assertTrue($obj->isCanChangeInfo());
        $this->assertTrue($obj->isCanInviteUsers());
        $this->assertTrue($obj->isCanPinMessages());
        $this->assertTrue($obj->isCanPostMessages());
        $this->assertTrue($obj->isCanEditMessages());
        $this->assertTrue($obj->isCanSendMessages());
        $this->assertTrue($obj->isCanPromoteMembers());
        $this->assertTrue($obj->isCanDeleteMessages());
        $this->assertTrue($obj->isCanRestrictMembers());
        $this->assertTrue($obj->isCanSendMediaMessages());
        $this->assertTrue($obj->isCanSendOtherMessages());
        $this->assertTrue($obj->isCanAddWebPagePreviews());

        $this->assertJson(json_encode($obj));
    }
}
