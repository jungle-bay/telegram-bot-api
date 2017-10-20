<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Supports\Validator;

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

        if (empty($caption) || (strlen($caption) > Validator::CAPTION_SIZE_MAX)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
    }
}
