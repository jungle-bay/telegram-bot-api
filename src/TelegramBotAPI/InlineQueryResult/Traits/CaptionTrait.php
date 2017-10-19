<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


use TelegramBotAPI\PrivateConst;
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

        if (empty($caption) || (strlen($caption) > PrivateConst::CAPTION_SIZE_MAX)) {
            throw new TelegramBotAPIException('Caption, 0-200 characters');
        }

        $this->caption = $caption;
    }
}
