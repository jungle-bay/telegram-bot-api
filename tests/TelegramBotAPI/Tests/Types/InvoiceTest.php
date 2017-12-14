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


use TelegramBotAPI\Constants;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\Types\Invoice;

/**
 * Class InvoiceTest
 * @package TelegramBotAPI\Tests\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InvoiceTest extends TestCase {

    public function testAccessors() {

        $obj = new Invoice();

        $obj->setTitle('title');
        $obj->setDescription('description');
        $obj->setCurrency(Constants::CURRENCY_UAH);
        $obj->setStartParameter('start_parameter');
        $obj->setTotalAmount(1);

        $this->assertEquals('title', $obj->getTitle());
        $this->assertEquals('description', $obj->getDescription());
        $this->assertEquals(Constants::CURRENCY_UAH, $obj->getCurrency());
        $this->assertEquals('start_parameter', $obj->getStartParameter());
        $this->assertEquals(1, $obj->getTotalAmount());

        $this->assertJson(json_encode($obj));
    }
}
