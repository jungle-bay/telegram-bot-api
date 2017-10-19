<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


trait DescriptionTrait {

    /**
     * @var null|string $description
     */
    protected $description;


    /**
     * @return null|string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }
}
