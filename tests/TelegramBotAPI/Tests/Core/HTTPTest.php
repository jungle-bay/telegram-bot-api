<?php

namespace TelegramBotAPI\Tests\Core;


use ReflectionClass;
use TelegramBotAPI\Core\HTTP;
use TelegramBotAPI\TelegramBotAPI;
use TelegramBotAPI\Tests\TelegramBotAPITestCase;

class HTTPTest extends TelegramBotAPITestCase {

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testCheckForBadRequest() {

        $class = new ReflectionClass(HTTP::class);
        $method = $class->getMethod('checkForBadRequest');
        $method->setAccessible(true);
        $obj = new HTTP();

        $method->invoke($obj, '{"ok":false,"error_code":404,"description":"Not Found: method not found"}');
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testSetUpdatesBadJSON() {

        $tba = new TelegramBotAPI($this->getToken());

        $tba->setUpdates('{');
    }


    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testGetURLEmpty() {

        $class = new ReflectionClass(HTTP::class);
        $method = $class->getMethod('get');
        $method->setAccessible(true);
        $obj = new HTTP();

        $method->invoke($obj, null);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIException
     */
    public function testPostURLEmpty() {

        $class = new ReflectionClass(HTTP::class);
        $method = $class->getMethod('post');
        $method->setAccessible(true);
        $obj = new HTTP();

        $method->invoke($obj, null);
    }

    /**
     * @expectedException \TelegramBotAPI\Exception\TelegramBotAPIRuntimeException
     */
    public function testBadHTTP() {

        $class = new ReflectionClass(HTTP::class);
        $method = $class->getMethod('post');
        $method->setAccessible(true);
        $obj = new HTTP();

        $method->invoke($obj, 'https://examp.com/tes');
    }
}
