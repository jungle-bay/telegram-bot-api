<?php

namespace TelegramBotAPI\Traits;


trait ThumbUrlTrait {

    /**
     * @var string|null $thumbUrl
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
