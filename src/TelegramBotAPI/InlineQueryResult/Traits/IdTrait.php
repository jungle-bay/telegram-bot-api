<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


trait IdTrait {

    /**
     * @var string $id
     */
    private $id;


    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }
}
