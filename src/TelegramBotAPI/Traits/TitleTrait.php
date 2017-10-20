<?php

namespace TelegramBotAPI\Traits;


trait TitleTrait {

    /**
     * @var string $title
     */
    protected $title;


    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }
}
