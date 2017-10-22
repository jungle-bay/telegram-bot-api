<?php

namespace TelegramBotAPI;


use PHPUnit\Framework\TestCase;

abstract class TelegramBotAPITestCase extends TestCase {

    /**
     * Return test bot token
     *
     * @return string
     */
    abstract protected function getToken();
}
