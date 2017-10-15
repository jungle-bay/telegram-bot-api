<?php

namespace TelegramBotAPI\Tests\InputMessageContent;


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InputMessageContent\InputTextMessageContent;

class InputTextMessageContentTest extends TestCase {

    public function testAccessors() {

        $init = array('text', Constants::MARKDOWN_PARSE_MODE, true);
        $setter = array('test', Constants::HTML_PARSE_MODE, false);

        $obj = new InputTextMessageContent(array(
            'message_text'             => $init[0],
            'parse_mode'               => $init[1],
            'disable_web_page_preview' => $init[2]
        ));

        $this->assertEquals($init[0], $obj->getMessageText());
        $this->assertEquals($init[1], $obj->getParseMode());
        $this->assertEquals($init[2], $obj->getDisableWebPagePreview());

        $obj->setMessageText($setter[0]);
        $obj->setParseMode($setter[1]);
        $obj->setDisableWebPagePreview($setter[2]);

        $this->assertEquals($setter[0], $obj->getMessageText());
        $this->assertEquals($setter[1], $obj->getParseMode());
        $this->assertEquals($setter[2], $obj->getDisableWebPagePreview());
    }
}
