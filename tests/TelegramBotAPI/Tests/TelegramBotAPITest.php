<?php

namespace TelegramBotAPI\Tests;


use TelegramBotAPI\Constants;
use TelegramBotAPI\Types\InputFile;
use TelegramBotAPI\Types\User;
use TelegramBotAPI\Types\Chat;
use TelegramBotAPI\Types\File;
use TelegramBotAPI\Types\Update;
use TelegramBotAPI\Types\Message;
use TelegramBotAPI\Types\ChatMember;
use TelegramBotAPI\Types\WebhookInfo;
use TelegramBotAPI\Types\LabeledPrice;
use TelegramBotAPI\Types\GameHighScore;
use TelegramBotAPI\TelegramBotAPI as TBA;
use TelegramBotAPI\Constants as TBAConst;
use TelegramBotAPI\TelegramBotAPITestCase;
use TelegramBotAPI\Types\UserProfilePhotos;
use phpDocumentor\Reflection\Types\String_;
use TelegramBotAPI\Types\InlineKeyboardButton;
use TelegramBotAPI\Types\InlineKeyboardMarkup;

/**
 * @package TelegramBotAPI\Tests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPITest extends TelegramBotAPITestCase {

    /**
     * Return test bot token
     *
     * @return string
     */
    protected function getToken() {
        //return '479218867:AAGjGTwl0F-prMPIC6-AkNuLD1Bb2tRsYbc';
        return '355932823:AAFDcLyd9nS3tJSgmSLaeZy8CaXLkdo0iIY';
    }

    /**
     * Return test user or chat id
     *
     * @return int|string
     */
    protected function getId() {
        return 59673324;
    }


    /** Tests Getting updates */

    public function testSetUpdates() {

        $tba = new TBA($this->getToken());

        $updates = $tba->setUpdates('{
    "ok": true,
    "result": [
        {
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
                "text": "/sadsa",
                "entities": [
                    {
                        "offset": 0,
                        "length": 6,
                        "type": "bot_command"
                    }
                ]
            }
        }
    ]
}');

        foreach ($updates as $update) {

            $this->assertNotNull($update);
            $this->assertInstanceOf(Update::class, $update);
        }

    }

    public function testGetUpdates() {

        $tba = new TBA($this->getToken());

        $updates = $tba->getUpdates();

        foreach ($updates as $update) {

            $this->assertNotNull($update);
            $this->assertInstanceOf(Update::class, $update);
        }
    }

    public function testSetWebhook() {

        $tba = new TBA($this->getToken());


        $isSetWebhook = $tba->setWebhook(array(
            'url' => 'https://www.example.com/' . $this->getToken()
        ));

        $this->assertNotNull($isSetWebhook);
        $this->assertTrue($isSetWebhook);
    }

    public function testDeleteWebhook() {

        $tba = new TBA($this->getToken());


        $isDeleteWebhook = $tba->deleteWebhook();

        $this->assertNotNull($isDeleteWebhook);
        $this->assertTrue($isDeleteWebhook);
    }

    public function testGetWebhookInfo() {

        $tba = new TBA($this->getToken());


        $webhookInfo = $tba->getWebhookInfo();

        $this->assertNotNull($webhookInfo);
        $this->assertInstanceOf(WebhookInfo::class, $webhookInfo);
    }

    /** Tests Available methods */

    public function testGetMe() {

        $tba = new TBA($this->getToken());


        $botInfo = $tba->getMe();

        $this->assertNotNull($botInfo);
        $this->assertInstanceOf(User::class, $botInfo);
    }

    public function testSendMessage() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendMessage(array(
            'chat_id' => $this->getId(),
            'text'    => 'Hello World!'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testForwardMessage() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->forwardMessage(array(
            'chat_id'      => $this->getId(),
            'from_chat_id' => $this->getId(),
            'message_id'   => 5
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
    }

    public function testSendPhoto() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendPhoto(array(
            'chat_id' => $this->getId(),
            'photo'   => 'AgADAgADuKcxG4QF6EsMJMijbYLItaREtw0ABOLuWOpqmQUotH4CAAEC'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendVideoNote() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->sendVideoNote(array(
            'chat_id'    => $this->getId(),
            'video_note' => 'DQADAgAD4gADXo5hS510sB6NjfxlAg',
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testEditMessageLiveLocation() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->editMessageLiveLocation(array(
            'chat_id'   => $this->getId(),
            'latitude'  => 35.023963,
            'longitude' => 48.424740
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testStopMessageLiveLocation() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->stopMessageLiveLocation(array(
            'chat_id' => $this->getId()
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testRestrictChatMember() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->restrictChatMember(array(
            'chat_id' => $this->getId(),
            'user_id' => $this->getId()
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testPromoteChatMember() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->promoteChatMember(array(
            'chat_id' => $this->getId(),
            'user_id' => $this->getId()
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testExportChatInviteLink() {

        $tba = new TBA($this->getToken());

        $link = $tba->exportChatInviteLink(array(
            'chat_id' => $this->getId()
        ));

        $this->assertNotNull($link);
        $this->assertInternalType(String_::class, $link);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatPhoto() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->setChatPhoto(array(
            'chat_id' => $this->getId(),
            'photo'   => 'AgADAgADuKcxG4QF6EsMJMijbYLItaREtw0ABOLuWOpqmQUotH4CAAEC'
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteChatPhoto() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->deleteChatPhoto(array(
            'chat_id' => $this->getId()
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatTitle() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->setChatTitle(array(
            'chat_id' => $this->getId(),
            'title'   => 'Title'
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatDescription() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->setChatDescription(array(
            'chat_id'     => $this->getId(),
            'description' => 'description'
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testPinChatMessage() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->pinChatMessage(array(
            'chat_id'    => $this->getId(),
            'message_id' => 5
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testUnpinChatMessage() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->unpinChatMessage(array(
            'chat_id' => $this->getId()
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetChatStickerSet() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->setChatStickerSet(array(
            'chat_id'          => $this->getId(),
            'sticker_set_name' => 'Hello world!'
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteChatStickerSet() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->deleteChatStickerSet(array(
            'chat_id' => $this->getId()
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testAnswerCallbackQuery() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->answerCallbackQuery(array(
            'callback_query_id' => $this->getId()
        ));

        $this->assertTrue($isSetPhoto);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteMessage() {

        $tba = new TBA($this->getToken());

        $isSetPhoto = $tba->deleteMessage(array(
            'chat_id'    => $this->getId(),
            'message_id' => 0
        ));

        $this->assertTrue($isSetPhoto);
    }

    public function testGetStickerSet() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->getStickerSet(array(
            'name' => 'LENIN'
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testUploadStickerFile() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->uploadStickerFile(array(
            'chat_id'     => $this->getToken(),
            'png_sticker' => ''
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testCreateNewStickerSet() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->createNewStickerSet(array(
            'user_id'     => $this->getToken(),
            'name'        => 'Hello www',
            'title'       => 'WWW',
            'png_sticker' => '',
            'emojis'      => '',
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testAddStickerToSet() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->addStickerToSet(array(
            'user_id'     => $this->getToken(),
            'name'        => 'Hello www',
            'emojis'      => '',
            'png_sticker' => ''
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetStickerPositionInSet() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->setStickerPositionInSet(array(
            'sticker'  => 'LENIN',
            'position' => ''
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testDeleteStickerFromSet() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->deleteStickerFromSet(array(
            'sticker' => 'LENINZ'
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testAnswerInlineQuery() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->answerInlineQuery(array(
            'inline_query_id' => 5,
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSendInvoice() {

        $tba = new TBA($this->getToken());

        $labeledPrice = new LabeledPrice();

        $labeledPrice->setLabel('iii');
        $labeledPrice->setAmount(314);
        $feedback = $tba->sendInvoice(array(
            'chat_id'         => $this->getId(),
            'title'           => 'title',
            'description'     => 'description',
            'payload'         => 'payload payload payload',
            'provider_token'  => 'provider_token',
            'start_parameter' => 'start_parameter',
            'currency'        => Constants::CURRENCY_UAH
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testAnswerShippingQuery() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->answerShippingQuery(array(
            'shipping_query_id' => 1,
            'ok'                => true,
        ));

        $this->assertNotNull($feedback);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testAnswerPreCheckoutQuery() {

        $tba = new TBA($this->getToken());

        $feedback = $tba->answerPreCheckoutQuery(array(
            'pre_checkout_query_id' => 1,
            'ok'                    => true,
        ));

        $this->assertNotNull($feedback);
    }

    public function testSendAudio() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendAudio(array(
            'chat_id' => $this->getId(),
            'audio'   => 'CQADAgADCQADhAXoS508c_4-8vv3Ag'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendDocument() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendDocument(array(
            'chat_id'  => $this->getId(),
            'document' => 'BQADAgADCwADhAXoS9zbiySyGOe0Ag'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendSticker() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendSticker(array(
            'chat_id' => $this->getId(),
            'sticker' => 'CAADBAADUQcAAhXc8gKpKJYytxw9CwI'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendVideo() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendVideo(array(
            'chat_id' => $this->getId(),
            'video'   => 'BAADAgADCgADhAXoSwGEHSLhDt6EAg'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendVoice() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendVoice(array(
            'chat_id' => $this->getId(),
            'voice'   => 'AwADAgADCAADhAXoS6dX4441hqLVAg'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendLocation() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendLocation(array(
            'chat_id'   => $this->getId(),
            'latitude'  => 48.424740,
            'longitude' => 35.023963
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendVenue() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendVenue(array(
            'chat_id'   => $this->getId(),
            'latitude'  => 48.424740,
            'longitude' => 35.023963,
            'title'     => 'Star square',
            'address'   => 'Gagarin Avenue'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendContact() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendContact(array(
            'chat_id'      => $this->getId(),
            'phone_number' => '+300003690000',
            'first_name'   => 'Bot'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    public function testSendChatAction() {

        $tba = new TBA($this->getToken());


        $chatAction = $tba->sendChatAction(array(
            'chat_id' => $this->getId(),
            'action'  => TBAConst::TYPING_TYPE_ACTION,
        ));

        $this->assertNotNull($chatAction);
        $this->assertTrue($chatAction);
    }

    public function testGetUserProfilePhotos() {

        $tba = new TBA($this->getToken());


        $userProfilePhotos = $tba->getUserProfilePhotos(array(
            'user_id' => $this->getId()
        ));

        $this->assertNotNull($userProfilePhotos);
        $this->assertInstanceOf(UserProfilePhotos::class, $userProfilePhotos);
    }

    public function testGetFile() {

        $tba = new TBA($this->getToken());


        $fileInfo = $tba->getFile(array(
            'file_id' => 'BQADAgADCwADhAXoS9zbiySyGOe0Ag',
        ));

        $this->assertNotNull($fileInfo);
        $this->assertInstanceOf(File::class, $fileInfo);
        $this->assertEquals('BQADAgADCwADhAXoS9zbiySyGOe0Ag', $fileInfo->getFileId());

        $fileData = $tba->getFile(array(
            'file_path' => $fileInfo->getFilePath()
        ));

        $this->assertNotNull($fileData);
        $this->assertEquals('string', gettype($fileData));
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testKickChatMember() {

        $tba = new TBA($this->getToken());


        $isKickChatMember = $tba->kickChatMember(array(
            'chat_id' => $this->getId(),
            'user_id' => $this->getId()
        ));

        $this->assertNotNull($isKickChatMember);
        $this->assertTrue($isKickChatMember);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testLeaveChat() {

        $tba = new TBA($this->getToken());


        $isLeaveChat = $tba->leaveChat(array(
            'chat_id' => $this->getId()
        ));

        $this->assertNotNull($isLeaveChat);
        $this->assertTrue($isLeaveChat);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testUnbanChatMember() {

        $tba = new TBA($this->getToken());


        $isUnbanChatMember = $tba->unbanChatMember(array(
            'chat_id' => $this->getId(),
            'user_id' => $this->getId()
        ));

        $this->assertNotNull($isUnbanChatMember);
        $this->assertTrue($isUnbanChatMember);
    }

    public function testGetChat() {

        $tba = new TBA($this->getToken());


        $chat = $tba->getChat(array(
            'chat_id' => $this->getId()
        ));

        $this->assertNotNull($chat);
        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertEquals($this->getId(), $chat->getId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testGetChatAdministrators() {

        $tba = new TBA($this->getToken());


        $chatAdministrators = $tba->getChatAdministrators(array(
            'chat_id' => $this->getId()
        ));

        foreach ($chatAdministrators as $chatMember) {

            $this->assertNotNull($chatMember);
            $this->assertInstanceOf(ChatMember::class, $chatMember);
        }
    }

    public function testGetChatMembersCount() {

        $tba = new TBA($this->getToken());


        $count = $tba->getChatMembersCount(array(
            'chat_id' => $this->getId()
        ));

        $this->assertNotNull($count);
        $this->assertEquals('integer', gettype($count));
    }

    public function testGetChatMember() {

        $tba = new TBA($this->getToken());


        $chatMember = $tba->getChatMember(array(
            'chat_id' => $this->getId(),
            'user_id' => $this->getId()
        ));

        $this->assertNotNull($chatMember);
        $this->assertInstanceOf(ChatMember::class, $chatMember);
        $this->assertEquals($this->getId(), $chatMember->getUser()->getId());
    }

    /** Tests Updating messages */

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testEditMessageText() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->editMessageText(array(
            'chat_id'    => $this->getId(),
            'message_id' => 5,
            'text'       => 'Hello World!!!'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
        $this->assertEquals(5, $feedback->getMessageId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testEditMessageCaption() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->editMessageCaption(array(
            'chat_id'    => $this->getId(),
            'message_id' => 5,
            'caption'    => 'Caption'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
        $this->assertEquals(5, $feedback->getMessageId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testEditMessageReplyMarkup() {

        $tba = new TBA($this->getToken());


        // build keyboard

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
            'chat_id'      => $this->getId(),
            'message_id'   => 5,
            'reply_markup' => $replyMarkup
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
        $this->assertEquals(5, $feedback->getMessageId());
    }

    /** Tests Inline mode */

    /** Tests Games */

    public function testSendGame() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->sendGame(array(
            'chat_id'         => $this->getId(),
            'game_short_name' => 'J1G'
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetGameScore() {

        $tba = new TBA($this->getToken());


        $feedback = $tba->setGameScore(array(
            'user_id'    => $this->getId(),
            'chat_id'    => $this->getId(),
            'message_id' => 5,
            'score'      => 1
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getFrom()->getId());
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
        $this->assertEquals(5, $feedback->getMessageId());
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testGetGameHighScores() {

        $tba = new TBA($this->getToken());


        $gameHighScores = $tba->getGameHighScores(array(
            'user_id'    => $this->getId(),
            'chat_id'    => $this->getId(),
            'message_id' => 5
        ));

        foreach ($gameHighScores as $gameHighScore) {

            $this->assertNotNull($gameHighScore);
            $this->assertInstanceOf(GameHighScore::class, $gameHighScore);
        }
    }

    public function testSendFile() {

        $pathFile = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array('..', 'Resources', 'archive.zip'));
        $file = new InputFile(__DIR__ . $pathFile, mime_content_type(__DIR__ . $pathFile));

        $tba = new TBA($this->getToken());

        $feedback = $tba->sendDocument(array(
            'chat_id'  => $this->getId(),
            'document' => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
    }

    public function testSendPhotoFile() {

        $pathFile = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array('..', 'Resources', 'images.png'));
        $file = new InputFile(__DIR__ . $pathFile, mime_content_type(__DIR__ . $pathFile));

        $tba = new TBA($this->getToken());

        $feedback = $tba->sendPhoto(array(
            'chat_id' => $this->getId(),
            'photo'   => $file
        ));

        $this->assertNotNull($feedback);
        $this->assertInstanceOf(Message::class, $feedback);
        $this->assertEquals($this->getId(), $feedback->getChat()->getId());
    }
}
