<?php

namespace TelegramBotAPI\Tests\Core;


use TelegramBotAPI\Core\HTTP;
use PHPUnit\Framework\TestCase;
use TelegramBotAPI\PrivateConst as TBAConst;

/**
 * @package TelegramBotAPI\Tests
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class HTTPTest extends TestCase {

    /**
     * @return string
     */
    protected function getToken() {
        //return '479218867:AAGjGTwl0F-prMPIC6-AkNuLD1Bb2tRsYbc';
        return '355932823:AAFDcLyd9nS3tJSgmSLaeZy8CaXLkdo0iIY';
    }

    /**
     * @return int
     */
    protected function getId() {
        return 59673324;
    }


    public function testGet() {

        $http = new HTTP();
        $url = sprintf(TBAConst::TELEGRAM_BOT_API, $this->getToken(), TBAConst::GET_ME);

        $result = $http->get($url);

        $this->assertNotNull($result);
        $this->assertEquals('string', gettype($result));
    }

    public function testPost() {

        $http = new HTTP();
        $url = sprintf(TBAConst::TELEGRAM_BOT_API, $this->getToken(), TBAConst::GET_FILE);

        $result = $http->post($url, array(
            'file_id' => 'BQADAgADCwADhAXoS9zbiySyGOe0Ag'
        ));

        $this->assertNotNull($result);
        $this->assertEquals('string', gettype($result));
    }
}
