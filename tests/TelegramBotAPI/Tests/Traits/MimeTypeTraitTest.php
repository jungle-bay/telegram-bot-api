<?php

namespace TelegramBotAPI\Tests\Traits;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultDocument;

class MimeTypeTraitTest extends TestCase {

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetMimeType() {

        $obj = new InlineQueryResultDocument();

        $obj->setMimeType('abc');
    }
}
