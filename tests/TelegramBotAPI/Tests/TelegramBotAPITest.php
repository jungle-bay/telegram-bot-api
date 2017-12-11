<?php

namespace TelegramBotAPI\Tests;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\Types\User;
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\File;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\TelegramBotAPI;
use TelegramBotAPI\Types\InputFile;
use TelegramBotAPI\Types\PhotoSize;
use TelegramBotAPI\Types\StickerSet;
use TelegramBotAPI\Types\ChatMember;
use TelegramBotAPI\Types\WebhookInfo;
use TelegramBotAPI\Types\LabeledPrice;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\Types\MessageEntity;
use TelegramBotAPI\Types\UserProfilePhotos;
use TelegramBotAPI\Constants;
use phpDocumentor\Reflection\Types\String_;
use TelegramBotAPI\Types\InlineKeyboardButton;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultArticle;

/**
 * @package TelegramBotAPI\Tests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPITest extends TestCase {

    /**
     * @param string $name
     * @return InputFile
     */
    private function getFileFromResource($name) {

        $pathFile = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array('..', 'Resources', $name));
        $file = new InputFile(__DIR__ . $pathFile, mime_content_type(__DIR__ . $pathFile));

        return $file;
    }

    /**
     * @return int
     */
    private function getUserId() {
        return 59673324;
    }

    /**
     * @return int
     */
    private function getBotId() {
        return 479218867;
    }


    /**
     * @return array
     */
    public function TBAProvider() {

        $tba = new TelegramBotAPI('479218867:AAGjGTwl0F-prMPIC6-AkNuLD1Bb2tRsYbc');

        return array(
            array($tba)
        );
    }


    /**
     * @throws TelegramBotAPIException
     */
    public function testSetToken() {

        $token = '479218867:AAGjGTwl0F-prMPIC6-AkNuLD1Bb2tRsYbc';

        $tba = new TelegramBotAPI();

        $tba->setToken($token);

        $this->assertNotNull($tba->getToken());
        $this->assertEquals($token, $tba->getToken());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetTokenNotValid(TelegramBotAPI $tba) {

        $tba->setToken('abc');
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws TelegramBotAPIException
     */
    public function testGetTokenEmpty() {

        $tba = new TelegramBotAPI();
        $tba->getToken();
    }


    /** Tests Getting updates */


    /**
     * @param TelegramBotAPI $tba
     *
     * @throws TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSetUpdates(TelegramBotAPI $tba) {

        $updates = $tba->setUpdates('{"ok": true,"result": [{
            "update_id": 747719235,
            "message": {
                "message_id": 1591,
                "from": {
                    "id": 59673324,
                    "is_bot": false,
                    "first_name": "Roma",
                    "last_name": "Baranenko",
                    "username": "roma_bb8",
                    "language_code": "ru"
                },
                "chat": {
                    "id": 59673324,
                    "first_name": "Roma",
                    "last_name": "Baranenko",
                    "username": "roma_bb8",
                    "type": "private"
                },
                "date": 1508587194,
                "text": "/cmd",
                "entities": [
                    {
                        "offset": 0,
                        "length": 4,
                        "type": "bot_command"
                    }
                ]
            }
        }]}');

        $this->assertTrue(is_array($updates));

        /** @var Update $update */
        $update = $updates[0];

        $this->assertNotNull($update);
        $this->assertInstanceOf(Update::class, $update);

        $this->assertEquals(747719235, $update->getUpdateId());

        $this->assertEquals(1591, $update->getMessage()->getMessageId());

        $this->assertEquals(59673324, $update->getMessage()->getFrom()->getId());
        $this->assertFalse($update->getMessage()->getFrom()->getBot());
        $this->assertEquals('Roma', $update->getMessage()->getFrom()->getFirstName());
        $this->assertEquals('Baranenko', $update->getMessage()->getFrom()->getLastName());
        $this->assertEquals('roma_bb8', $update->getMessage()->getFrom()->getUsername());
        $this->assertEquals('ru', $update->getMessage()->getFrom()->getLanguageCode());

        $this->assertEquals(59673324, $update->getMessage()->getChat()->getId());
        $this->assertEquals('Roma', $update->getMessage()->getChat()->getFirstName());
        $this->assertEquals('Baranenko', $update->getMessage()->getChat()->getLastName());
        $this->assertEquals('roma_bb8', $update->getMessage()->getChat()->getUsername());
        $this->assertEquals('private', $update->getMessage()->getChat()->getType());

        $this->assertEquals(1508587194, $update->getMessage()->getDate());
        $this->assertEquals('/cmd', $update->getMessage()->getText());

        /** @var MessageEntity $entity */
        $entity = $update->getMessage()->getEntities()[0];

        $this->assertEquals(0, $entity->getOffset());
        $this->assertEquals(4, $entity->getLength());
        $this->assertEquals('bot_command', $entity->getType());
    }

    /**
     * @param TelegramBotAPI $tba
     *
     * @throws TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetUpdates(TelegramBotAPI $tba) {

        $updates = $tba->getUpdates();

        foreach ($updates as $update) {

            $this->assertNotNull($update);
            $this->assertInstanceOf(Update::class, $update);
        }
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSetWebhook(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->setWebhook(array(
            'url' => 'https://www.example.com/123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11/'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testDeleteWebhook(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->deleteWebhook();

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetWebhookInfo(TelegramBotAPI $tba) {

        $webhookInfo = $tba->getWebhookInfo();

        $this->assertNotNull($webhookInfo);
        $this->assertInstanceOf(WebhookInfo::class, $webhookInfo);

        $this->assertEquals('', $webhookInfo->getUrl());
        $this->assertFalse($webhookInfo->getHasCustomCertificate());
    }


    /** Tests Available methods */


    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetMe(TelegramBotAPI $tba) {

        $info = $tba->getMe();

        $this->assertNotNull($info);
        $this->assertInstanceOf(User::class, $info);

        $this->assertEquals('479218867', $info->getId());
        $this->assertTrue($info->getBot());
        $this->assertEquals('TestBot', $info->getFirstName());
        $this->assertEquals('TBAPHPBot', $info->getUsername());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendMessage(TelegramBotAPI $tba) {

        $feedback = $tba->sendMessage(array(
            'chat_id' => $this->getUserId(),
            'text'    => 'Hello World!'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
        $this->assertEquals('Hello World!', $feedback->getText());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testForwardMessage(TelegramBotAPI $tba) {

        $feedback = $tba->forwardMessage(array(
            'chat_id'      => $this->getUserId(),
            'from_chat_id' => $this->getUserId(),
            'message_id'   => 5
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendPhotoInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('images.png');
        $feedback = $tba->sendPhoto(array(
            'chat_id' => $this->getUserId(),
            'photo'   => $file,
            'caption' => 'Logo Telegram'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendPhoto(TelegramBotAPI $tba) {

        $feedback = $tba->sendPhoto(array(
            'chat_id' => $this->getUserId(),
            'photo'   => 'AgADAgADW6gxG9jbkEtw7Cl9N7j9RAHYDw4ABOiIf357g__TEFcCAAEC'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
        $this->assertNotNull($feedback->getPhoto());

        if (is_array($feedback->getPhoto())) {

            foreach ($feedback->getPhoto() as $photoSize) {

                $this->assertNotNull($photoSize);
                $this->assertInstanceOf(PhotoSize::class, $photoSize);
            }
        }
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVideoNoteInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('video.mp4');
        $feedback = $tba->sendVideoNote(array(
            'chat_id'    => $this->getUserId(),
            'video_note' => $file,
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVideoNote(TelegramBotAPI $tba) {

        $feedback = $tba->sendVideoNote(array(
            'chat_id'    => $this->getUserId(),
            'video_note' => 'DQADAgAD8AAD2NuYS-E4iW-GzcRJAg',
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testEditMessageLiveLocation(TelegramBotAPI $tba) {

        $feedback = $tba->editMessageLiveLocation(array(
            'chat_id'    => $this->getUserId(),
            'message_id' => 20,
            'latitude'   => 35.023963,
            'longitude'  => 48.424741
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testStopMessageLiveLocation(TelegramBotAPI $tba) {

        $feedback = $tba->stopMessageLiveLocation(array(
            'chat_id'    => $this->getUserId(),
            'message_id' => 20
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testRestrictChatMember(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->restrictChatMember(array(
            'chat_id' => $this->getUserId(),
            'user_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testPromoteChatMember(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->promoteChatMember(array(
            'chat_id' => $this->getUserId(),
            'user_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testExportChatInviteLink(TelegramBotAPI $tba) {

        $link = $tba->exportChatInviteLink(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($link);
        $this->assertInternalType(String_::class, $link);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatPhoto(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('images.png');
        $isSuccessfully = $tba->setChatPhoto(array(
            'chat_id' => $this->getUserId(),
            'photo'   => $file
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteChatPhoto(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->deleteChatPhoto(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatTitle(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->setChatTitle(array(
            'chat_id' => $this->getUserId(),
            'title'   => 'Title'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatDescription(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->setChatDescription(array(
            'chat_id'     => $this->getUserId(),
            'description' => 'description'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testPinChatMessage(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->pinChatMessage(array(
            'chat_id'    => $this->getUserId(),
            'message_id' => 5
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testUnpinChatMessage(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->unpinChatMessage(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatStickerSet(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->setChatStickerSet(array(
            'chat_id'          => $this->getUserId(),
            'sticker_set_name' => 'PHP_TEST_STICKER_NAME'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteChatStickerSet(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->deleteChatStickerSet(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testAnswerCallbackQuery(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->answerCallbackQuery(array(
            'callback_query_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteMessage(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->deleteMessage(array(
            'chat_id'    => $this->getUserId(),
            'message_id' => 0
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetStickerSet(TelegramBotAPI $tba) {

        $feedback = $tba->getStickerSet(array(
            'name' => 'LENIN'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(StickerSet::class, $feedback);

        $this->assertEquals('Lenin', $feedback->getName());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testUploadStickerFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('images.png');
        $feedback = $tba->uploadStickerFile(array(
            'chat_id'     => $this->getUserId(),
            'png_sticker' => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(File::class, $feedback);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testCreateNewStickerSet(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->createNewStickerSet(array(
            'user_id'     => $this->getUserId(),
            'name'        => 'Hello www',
            'title'       => 'WWW',
            'png_sticker' => '',
            'emojis'      => '',
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testAddStickerToSet(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->addStickerToSet(array(
            'user_id'     => $this->getUserId(),
            'name'        => 'Hello www',
            'emojis'      => '',
            'png_sticker' => ''
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetStickerPositionInSet(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->setStickerPositionInSet(array(
            'sticker'  => 'LENIN',
            'position' => 0
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteStickerFromSet(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->deleteStickerFromSet(array(
            'sticker' => 'LENINZ'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSendInvoice(TelegramBotAPI $tba) {

        $labeledPrice = new LabeledPrice();

        $labeledPrice->setLabel('My price');
        $labeledPrice->setAmount(369);

        $prices = array();
        $prices[] = $labeledPrice;

        $feedback = $tba->sendInvoice(array(
            'chat_id'         => $this->getUserId(),
            'title'           => 'Title',
            'description'     => 'Description',
            'payload'         => 'Payload payload payload',
            'provider_token'  => 'Provider token',
            'start_parameter' => 'Start parameter',
            'currency'        => Constants::CURRENCY_UAH,
            'prices'          => $prices
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testAnswerShippingQuery(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->answerShippingQuery(array(
            'shipping_query_id' => 1,
            'ok'                => false,
            'error_message'     => 'Sorry, delivery to your desired address is unavailable'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testAnswerPreCheckoutQuery(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->answerPreCheckoutQuery(array(
            'pre_checkout_query_id' => 1,
            'ok'                    => false,
            'error_message'         => 'Please choose a different color or garment!'
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendAudioInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('sound.mp3');
        $feedback = $tba->sendAudio(array(
            'chat_id' => $this->getUserId(),
            'audio'   => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendAudio(TelegramBotAPI $tba) {

        $feedback = $tba->sendAudio(array(
            'chat_id' => $this->getUserId(),
            'audio'   => 'CQADAgAD-wAD2NuYS55wTl2h9PM9Ag'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendDocumentInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('text.txt');
        $feedback = $tba->sendDocument(array(
            'chat_id'  => $this->getUserId(),
            'document' => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendDocument(TelegramBotAPI $tba) {

        $feedback = $tba->sendDocument(array(
            'chat_id'  => $this->getUserId(),
            'document' => 'BQADAgAD_gAD2NuYS0_h2FCaToxBAg'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendStickerInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('dog.webp');
        $feedback = $tba->sendSticker(array(
            'chat_id' => $this->getUserId(),
            'sticker' => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendSticker(TelegramBotAPI $tba) {

        $feedback = $tba->sendSticker(array(
            'chat_id' => $this->getUserId(),
            'sticker' => 'CAADBAADUQcAAhXc8gKpKJYytxw9CwI'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVideoInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('video.mp4');
        $feedback = $tba->sendVideo(array(
            'chat_id' => $this->getUserId(),
            'video'   => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVideo(TelegramBotAPI $tba) {

        $feedback = $tba->sendVideo(array(
            'chat_id' => $this->getUserId(),
            'video'   => 'BAADAgADfwAD2NuQS6RdlqnPwJdhAg'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVoiceInputFile(TelegramBotAPI $tba) {

        $file = $this->getFileFromResource('voice.ogg');
        $feedback = $tba->sendVoice(array(
            'chat_id' => $this->getUserId(),
            'voice'   => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVoice(TelegramBotAPI $tba) {

        $feedback = $tba->sendVoice(array(
            'chat_id' => $this->getUserId(),
            'voice'   => 'AwADAgAD8QAD2NuYS7er_Yib98VYAg'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendLocation(TelegramBotAPI $tba) {

        $feedback = $tba->sendLocation(array(
            'chat_id'   => $this->getUserId(),
            'latitude'  => 48.424740,
            'longitude' => 35.023963
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendVenue(TelegramBotAPI $tba) {

        $feedback = $tba->sendVenue(array(
            'chat_id'   => $this->getUserId(),
            'latitude'  => 48.424740,
            'longitude' => 35.023963,
            'title'     => 'Star square',
            'address'   => 'Gagarin Avenue'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendContact(TelegramBotAPI $tba) {

        $feedback = $tba->sendContact(array(
            'chat_id'      => $this->getUserId(),
            'phone_number' => '+300003690000',
            'first_name'   => 'Bot'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getBotId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testSendChatAction(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->sendChatAction(array(
            'chat_id' => $this->getUserId(),
            'action'  => Constants::TYPING_TYPE_ACTION,
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetUserProfilePhotos(TelegramBotAPI $tba) {

        $userProfilePhotos = $tba->getUserProfilePhotos(array(
            'user_id' => $this->getUserId()
        ));

        $this->assertNotNull($userProfilePhotos);
        $this->assertInstanceOf(UserProfilePhotos::class, $userProfilePhotos);

        $photos = $userProfilePhotos->getPhotos();

        foreach ($photos as $photo) {
            foreach ($photo as $item) {

                $this->assertNotNull($userProfilePhotos);
                $this->assertInstanceOf(PhotoSize::class, $item);
            }
        }
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetFile(TelegramBotAPI $tba) {

        $file = $tba->getFile(array(
            'file_id' => 'AwADAgAD8QAD2NuYS7er_Yib98VYAg',
        ));

        $this->assertNotNull($file);
        $this->assertInstanceOf(File::class, $file);

        $this->assertEquals('AwADAgAD8QAD2NuYS7er_Yib98VYAg', $file->getFileId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testLoadFile(TelegramBotAPI $tba) {

        $file = $tba->getFile(array(
            'file_id' => 'AwADAgAD8QAD2NuYS7er_Yib98VYAg'
        ));

        $file = $tba->loadFile(array(
            'file_path' => $file->getFilePath()
        ));

        $this->assertNotNull($file);
        $this->assertTrue(is_string($file));
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testKickChatMember(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->kickChatMember(array(
            'chat_id' => $this->getUserId(),
            'user_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testLeaveChat(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->leaveChat(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testUnbanChatMember(TelegramBotAPI $tba) {

        $isSuccessfully = $tba->unbanChatMember(array(
            'chat_id' => $this->getUserId(),
            'user_id' => $this->getUserId()
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetChat(TelegramBotAPI $tba) {

        $chat = $tba->getChat(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($chat);
        $this->assertInstanceOf(Chat::class, $chat);

        $this->assertEquals($this->getUserId(), $chat->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testGetChatAdministrators(TelegramBotAPI $tba) {

        $chatAdministrators = $tba->getChatAdministrators(array(
            'chat_id' => $this->getUserId()
        ));

        foreach ($chatAdministrators as $chatMember) {

            $this->assertNotNull($chatMember);
            $this->assertInstanceOf(ChatMember::class, $chatMember);

            $this->assertEquals($this->getUserId(), $chatMember->getUser()->getId());
        }
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetChatMembersCount(TelegramBotAPI $tba) {

        $count = $tba->getChatMembersCount(array(
            'chat_id' => $this->getUserId()
        ));

        $this->assertNotNull($count);
        $this->assertTrue(is_integer($count));
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     */
    public function testGetChatMember(TelegramBotAPI $tba) {

        $chatMember = $tba->getChatMember(array(
            'chat_id' => $this->getUserId(),
            'user_id' => $this->getUserId()
        ));

        $this->assertNotNull($chatMember);
        $this->assertInstanceOf(ChatMember::class, $chatMember);

        $this->assertEquals($this->getUserId(), $chatMember->getUser()->getId());
    }


    /** Tests Updating messages */


    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testEditMessageText(TelegramBotAPI $tba) {

        $feedback = $tba->editMessageText(array(
            'chat_id'    => $this->getUserId(),
            'message_id' => 5,
            'text'       => 'Hello World!!!'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals(5, $feedback->getMessageId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testEditMessageCaption(TelegramBotAPI $tba) {

        $feedback = $tba->editMessageCaption(array(
            'chat_id'    => $this->getUserId(),
            'message_id' => 5,
            'caption'    => 'Caption'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals(5, $feedback->getMessageId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testEditMessageReplyMarkup(TelegramBotAPI $tba) {

        $solarSystem = array();
        $zeroRow = array();
        $oneRow = array();
        $twoRow = array();
        $treeRow = array();
        $fourRow = array();

        $buttonSonnets = new InlineKeyboardButton();
        $buttonSonnets->setText('Sonnets');

        $buttonMercury = new InlineKeyboardButton();
        $buttonMercury->setText('Mercury');

        $buttonVenus = new InlineKeyboardButton();
        $buttonVenus->setText('Venus');

        $buttonEarth = new InlineKeyboardButton();
        $buttonEarth->setText('Earth');

        $buttonLinen = new InlineKeyboardButton();
        $buttonLinen->setText('Linen');

        $buttonMars = new InlineKeyboardButton();
        $buttonMars->setText('Mars');

        $zeroRow[] = $buttonSonnets;
        $oneRow[] = $buttonMercury;
        $twoRow[] = $buttonVenus;
        $treeRow[] = $buttonEarth;
        $treeRow[] = $buttonLinen;
        $fourRow[] = $buttonMars;

        $solarSystem[] = $zeroRow;
        $solarSystem[] = $oneRow;
        $solarSystem[] = $twoRow;
        $solarSystem[] = $treeRow;
        $solarSystem[] = $fourRow;

        $replyMarkup = new InlineKeyboardMarkup();

        $replyMarkup->setInlineKeyboard($solarSystem);

        // begin test

        $feedback = $tba->editMessageReplyMarkup(array(
            'chat_id'      => $this->getUserId(),
            'message_id'   => 5,
            'reply_markup' => $replyMarkup
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals(5, $feedback->getMessageId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }


    /** Tests Inline mode */


    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testAnswerInlineQuery(TelegramBotAPI $tba) {

        $inlineQueryResultArticle = new InlineQueryResultArticle();

        $inlineQueryResultArticle->setId(5);
        $inlineQueryResultArticle->setTitle('roma_bb8');
        $inlineQueryResultArticle->setUrl('https://roma-bb8.github.io/');

        $results = array();
        $results[] = $inlineQueryResultArticle;

        $isSuccessfully = $tba->answerInlineQuery(array(
            'inline_query_id' => 5,
            'results'         => $results
        ));

        $this->assertNotNull($isSuccessfully);
        $this->assertTrue($isSuccessfully);
    }


    /** Tests Games */


    /**
     * @param TelegramBotAPI $tba
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSendGame(TelegramBotAPI $tba) {

        $feedback = $tba->sendGame(array(
            'chat_id'         => $this->getUserId(),
            'game_short_name' => 'PHPGame'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetGameScore(TelegramBotAPI $tba) {

        $feedback = $tba->setGameScore(array(
            'user_id'    => $this->getUserId(),
            'chat_id'    => $this->getUserId(),
            'message_id' => 5,
            'score'      => 1
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);

        $this->assertEquals(5, $feedback->getMessageId());
        $this->assertEquals($this->getUserId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getUserId(), $feedback->getChat()->getId());
    }

    /**
     * @param TelegramBotAPI $tba
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     * @dataProvider TBAProvider
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testGetGameHighScores(TelegramBotAPI $tba) {

        $gameHighScores = $tba->getGameHighScores(array(
            'user_id'    => $this->getUserId(),
            'chat_id'    => $this->getUserId(),
            'message_id' => 5
        ));

        foreach ($gameHighScores as $gameHighScore) {

            $this->assertNotNull($gameHighScore);
            $this->assertInstanceOf(GameHighScore::class, $gameHighScore);
        }
    }
}
