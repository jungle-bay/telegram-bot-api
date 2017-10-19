<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


trait ThumbHeightTrait {

    /**
     * @var null|int $thumbHeight
     */
    protected $thumbHeight;


    /**
     * @return int|null
     */
    public function getThumbHeight() {
        return $this->thumbHeight;
    }

    /**
     * @param int|null $thumbHeight
     */
    public function setThumbHeight($thumbHeight) {
        $this->thumbHeight = $thumbHeight;
    }
}
