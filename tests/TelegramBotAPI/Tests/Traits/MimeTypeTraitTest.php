<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\Tests\Traits;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\InlineQueryResult\InlineQueryResultDocument;

/**
 * Class MimeTypeTraitTest
 * @package TelegramBotAPI\Tests\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class MimeTypeTraitTest extends TestCase {

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     * @throws \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testSetMimeType() {

        $obj = new InlineQueryResultDocument();

        $obj->setMimeType('abc');
    }
}
