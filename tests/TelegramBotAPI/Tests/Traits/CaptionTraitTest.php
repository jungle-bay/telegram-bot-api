<?php

namespace TelegramBotAPI\Tests\Traits;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultDocument;

class CaptionTraitTest extends TestCase {

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetCaption() {

        $obj = new InlineQueryResultDocument();

        $obj->setCaption('');
    }
}
