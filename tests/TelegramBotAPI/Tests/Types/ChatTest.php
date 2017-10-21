<?php

namespace TelegramBotAPI\Tests\Types;


use TelegramBotAPI\Types\Chat;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\ChatPhoto;

class ChatTest extends TestCase {

    public function testAccessors() {

        $obj = new Chat();

        $obj->setId('id');
        $obj->setTitle('title');
        $obj->setDescription('description');
        $obj->setFirstName('first_name');
        $obj->setLastName('last_name');
        $obj->setPhoto(new ChatPhoto());
        $obj->setType('type');
        $obj->setAllMembersAreAdministrators(true);
        $obj->setCanSetStickerSet(true);
        $obj->setInviteLink('invite_link');
        $obj->setPinnedMessage(new Message());
        $obj->setStickerSetName('sticker_set_name');
        $obj->setUsername('username');

        $this->assertEquals('id', $obj->getId());
        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('description', $obj->getDescription());
        $this->assertEquals('first_name', $obj->getFirstName());
        $this->assertEquals('last_name', $obj->getLastName());
        $this->assertInstanceOf(ChatPhoto::class, $obj->getPhoto());
        $this->assertEquals('type', $obj->getType());
        $this->assertTrue($obj->getAllMembersAreAdministrators());
        $this->assertTrue($obj->getCanSetStickerSet());
        $this->assertEquals('invite_link', $obj->getInviteLink());
        $this->assertInstanceOf(Message::class, $obj->getPinnedMessage());
        $this->assertEquals('sticker_set_name', $obj->getStickerSetName());
        $this->assertEquals('username', $obj->getUsername());

        $this->assertJson(json_encode($obj));
    }
}
