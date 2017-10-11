<?php

namespace TelegramBotAPI;


use PHPUnit\Framework\TestCase;

/**
 * @package TelegramBotAPI
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class TelegramBotAPITestCase extends TestCase {

    /**
     * Return test bot token
     *
     * @return string
     */
    abstract protected function getToken();

    /**
     * Return test user or chat id
     *
     * @return int|string
     */
    abstract protected function getId();
}
