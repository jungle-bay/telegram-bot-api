<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Core\HTTP;

trait UrlTrait {

    use TokenTrait;

    /**
     * @param string $method
     * @return string
     */
    protected function getUrl($method) {

        $url = sprintf(HTTP::TELEGRAM_BOT_API, $this->getToken(), $method);

        return $url;
    }
}
