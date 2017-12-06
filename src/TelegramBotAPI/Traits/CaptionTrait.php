<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;

trait CaptionTrait {

    /**
     * @var null|string $caption
     */
    protected $caption;


    /**
     * @return null|string
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     * @param null|string $caption
     * @throws TelegramBotAPIException
     */
    public function setCaption($caption) {

        if (empty($caption) || (strlen($caption) > 200)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
    }
}
