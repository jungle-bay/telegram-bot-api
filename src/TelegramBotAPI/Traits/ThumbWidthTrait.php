<?php

namespace TelegramBotAPI\Traits;


trait ThumbWidthTrait {

    /**
     * @var null|int $thumbWidth
     */
    protected $thumbWidth;


    /**
     * @return int|null
     */
    public function getThumbWidth() {
        return $this->thumbWidth;
    }

    /**
     * @param int|null $thumbWidth
     */
    public function setThumbWidth($thumbWidth) {
        $this->thumbWidth = $thumbWidth;
    }
}
