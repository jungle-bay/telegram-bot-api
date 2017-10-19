<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


trait ThumbUrlTrait {

    /**
     * @var string $thumbUrl
     */
    protected $thumbUrl;


    /**
     * @return string
     */
    public function getThumbUrl() {
        return $this->thumbUrl;
    }

    /**
     * @param string $thumbUrl
     */
    public function setThumbUrl($thumbUrl) {
        $this->thumbUrl = $thumbUrl;
    }
}
