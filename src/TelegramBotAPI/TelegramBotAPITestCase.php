<?php

namespace TelegramBotAPI;


use PHPUnit\Framework\TestCase;

abstract class TelegramBotAPITestCase extends TestCase {

    /**
     * Return test bot token
     *
     * @return string
     */
    protected function getToken() {
        //return '479218867:AAGjGTwl0F-prMPIC6-AkNuLD1Bb2tRsYbc';
        return '355932823:AAFDcLyd9nS3tJSgmSLaeZy8CaXLkdo0iIY';
    }

    /**
     * Return test user or chat id
     *
     * @return int|string
     */
    protected function getId() {
        return 59673324;
    }
}
