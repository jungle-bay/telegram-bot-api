<?php

namespace TelegramBotAPI\Traits;


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
