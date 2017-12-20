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
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\Game;
use TelegramBotAPI\Types\Audio;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Venue;
use TelegramBotAPI\Types\Video;
use TelegramBotAPI\Types\Voice;
use TelegramBotAPI\Types\Contact;
use TelegramBotAPI\Types\Invoice;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\Sticker;
use TelegramBotAPI\Types\Document;
use TelegramBotAPI\Types\Location;
use TelegramBotAPI\Types\VideoNote;
use TelegramBotAPI\Types\SuccessfulPayment;

/**
 * Class MessageTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class MessageTest extends TestCase {

    public function testAccessors() {

        $obj = new Message();

        $obj->setMessageId(123456);
        $obj->setFrom(new User());
        $obj->setDate(654321);
        $obj->setChat(new Chat());
        $obj->setForwardFrom(new User());
        $obj->setForwardFromChat(new Chat());
        $obj->setForwardFromMessageId(1);
        $obj->setForwardDate(765432);
        $obj->setReplyToMessage(new Message());
        $obj->setEditDate(876543);
        $obj->setText('text');
        $obj->setEntities(array());
        $obj->setAudio(new Audio());
        $obj->setDocument(new Document());
        $obj->setGame(new Game());
        $obj->setPhoto(array());
        $obj->setSticker(new Sticker());
        $obj->setVideo(new Video());
        $obj->setVideoNote(new VideoNote());
        $obj->setNewChatMembers(array());
        $obj->setVoice(new Voice());
        $obj->setCaption('caption');
        $obj->setContact(new Contact());
        $obj->setLocation(new Location());
        $obj->setVenue(new Venue());
        $obj->setLeftChatMember(new User());
        $obj->setNewChatTitle('new chat title');
        $obj->setNewChatPhoto(array());
        $obj->setDeleteChatPhoto(true);
        $obj->setGroupChatCreated(true);
        $obj->setSupergroupChatCreated(true);
        $obj->setChannelChatCreated(true);
        $obj->setMigrateToChatId(1);
        $obj->setMigrateFromChatId(2);
        $obj->setPinnedMessage(new Message());
        $obj->setInvoice(new Invoice());
        $obj->setSuccessfulPayment(new SuccessfulPayment());
        $obj->setAuthorSignature('author_signature');
        $obj->setForwardSignature('forward_signature');
        $obj->setCaptionEntities(array());

        $this->assertEquals(123456, $obj->getMessageId());
        $this->assertInstanceOf(User::class, $obj->getFrom());
        $this->assertEquals(654321, $obj->getDate());
        $this->assertInstanceOf(Chat::class, $obj->getChat());
        $this->assertInstanceOf(User::class, $obj->getForwardFrom());
        $this->assertInstanceOf(Chat::class, $obj->getForwardFromChat());
        $this->assertEquals(1, $obj->getForwardFromMessageId());
        $this->assertEquals(765432, $obj->getForwardDate());
        $this->assertInstanceOf(Message::class, $obj->getReplyToMessage());
        $this->assertEquals(876543, $obj->getEditDate());
        $this->assertEquals('text', $obj->getText());
        $this->assertInstanceOf(Audio::class, $obj->getAudio());
        $this->assertInstanceOf(Document::class, $obj->getDocument());
        $this->assertInstanceOf(Game::class, $obj->getGame());
        $this->assertInstanceOf(Sticker::class, $obj->getSticker());
        $this->assertInstanceOf(Video::class, $obj->getVideo());
        $this->assertInstanceOf(VideoNote::class, $obj->getVideoNote());
        $this->assertEquals('array', gettype($obj->getNewChatMembers()));
        $this->assertInstanceOf(Voice::class, $obj->getVoice());
        $this->assertEquals('caption', $obj->getCaption());
        $this->assertInstanceOf(Contact::class, $obj->getContact());
        $this->assertInstanceOf(Location::class, $obj->getLocation());
        $this->assertInstanceOf(Venue::class, $obj->getVenue());
        $this->assertInstanceOf(User::class, $obj->getLeftChatMember());
        $this->assertEquals('new chat title', $obj->getNewChatTitle());
        $this->assertEquals('array', gettype($obj->getNewChatPhoto()));
        $this->assertTrue($obj->isDeleteChatPhoto());
        $this->assertTrue($obj->isGroupChatCreated());
        $this->assertTrue($obj->isSupergroupChatCreated());
        $this->assertTrue($obj->isChannelChatCreated());
        $this->assertEquals(1, $obj->getMigrateToChatId());
        $this->assertEquals(2, $obj->getMigrateFromChatId());
        $this->assertInstanceOf(Message::class, $obj->getPinnedMessage());
        $this->assertInstanceOf(Invoice::class, $obj->getInvoice());
        $this->assertInstanceOf(SuccessfulPayment::class, $obj->getSuccessfulPayment());
        $this->assertEquals('author_signature', $obj->getAuthorSignature());
        $this->assertEquals('forward_signature', $obj->getForwardSignature());
        $this->assertEquals('array', gettype($obj->getCaptionEntities()));

        $this->assertJson(json_encode($obj));
    }
}
