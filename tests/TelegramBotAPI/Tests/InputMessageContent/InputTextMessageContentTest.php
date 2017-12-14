<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\InputMessageContent;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputTextMessageContent;

/**
 * Class InputTextMessageContentTest
 * @package TelegramBotAPI\Tests\InputMessageContent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputTextMessageContentTest extends TestCase {

    private function gettersTest(InputTextMessageContent $obj) {

        $this->assertEquals('text', $obj->getMessageText());
        $this->assertEquals(Constants::MARKDOWN_PARSE_MODE, $obj->getParseMode());
        $this->assertTrue($obj->isDisableWebPagePreview());
    }


    public function testJsonToObj() {

        $obj = new InputTextMessageContent(array(
            'message_text'             => 'text',
            'parse_mode'               => Constants::MARKDOWN_PARSE_MODE,
            'disable_web_page_preview' => true
        ));

        $this->gettersTest($obj);

        return $obj;
    }

    /**
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetters() {

        $obj = new InputTextMessageContent();

        $obj->setMessageText('text');
        $obj->setParseMode(Constants::MARKDOWN_PARSE_MODE);
        $obj->setDisableWebPagePreview(true);

        $this->gettersTest($obj);
    }

    /**
     * @param InputTextMessageContent $obj
     *
     * @depends testJsonToObj
     */
    public function testObjToJson(InputTextMessageContent $obj) {

        $json = json_encode($obj);
        $obj = json_decode($json, true);

        $this->assertJson($json);
        $this->assertArrayHasKey('message_text', $obj);
        $this->assertArrayHasKey('parse_mode', $obj);
        $this->assertArrayHasKey('disable_web_page_preview', $obj);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetMessageText() {

        $obj = new InputTextMessageContent();

        $obj->setMessageText(null);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetMessageTextSize() {

        $obj = new InputTextMessageContent();

        $str = '';

        for ($i = 0; $i < 4098; $i++) {
            $str .= 'a';
        }

        $obj->setMessageText($str);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetParseMode() {

        $obj = new InputTextMessageContent();

        $obj->setParseMode('x');
    }
}
