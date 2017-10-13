<?php

namespace TelegramBotAPI\Tests\Entities;


use PHPUnit\Framework\TestCase;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Entities\HTTP;

/**
 * @package TelegramBotAPI\Tests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class HTTPTest extends TestCase {

    /**
     * @return string
     */
    public function getToken() {
        //return '479218867:AAGjGTwl0F-prMPIC6-AkNuLD1Bb2tRsYbc';
        return '355932823:AAFDcLyd9nS3tJSgmSLaeZy8CaXLkdo0iIY';
    }


    public function testGet() {

        $http = new HTTP();
        $url = sprintf(PrivateConst::TELEGRAM_BOT_API, $this->getToken(), PrivateConst::GET_ME);

        $result = $http->get($url);
        $result = json_decode($result);

        $this->assertNotNull($result);
        $this->assertArrayHasKey('ok', $result);
        $this->assertArrayHasKey('result', $result);
        $this->assertArrayHasKey('id', $result['result']);
        $this->assertArrayHasKey('is_bot', $result['result']);
        $this->assertArrayHasKey('first_name', $result['result']);
        $this->assertArrayHasKey('username', $result['result']);
    }

    public function testPost() {

        $http = new HTTP();
        $url = sprintf(PrivateConst::TELEGRAM_BOT_API, $this->getToken(), PrivateConst::GET_FILE);

        $result = $http->post($url, array(
            'file_id' => 'BQADAgADCwADhAXoS9zbiySyGOe0Ag'
        ));
        $result = json_decode($result);

        $this->assertNotNull($result);
        $this->assertArrayHasKey('ok', $result);
        $this->assertArrayHasKey('result', $result);
        $this->assertArrayHasKey('file_id', $result['result']);
        $this->assertArrayHasKey('file_size', $result['result']);
        $this->assertArrayHasKey('file_path', $result['result']);
    }
}
