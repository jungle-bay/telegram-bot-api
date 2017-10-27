<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputTextMessageContent;

class InputTextMessageContentTest extends TestCase {

    private function gettersTest(InputTextMessageContent $obj) {

        $this->assertEquals('text', $obj->getMessageText());
        $this->assertEquals(Constants::MARKDOWN_PARSE_MODE, $obj->getParseMode());
        $this->assertTrue($obj->getDisableWebPagePreview());
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
}
