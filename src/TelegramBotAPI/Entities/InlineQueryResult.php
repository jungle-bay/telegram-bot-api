<?php

namespace TelegramBotAPI\Entities;


/**
 * @package TelegramBotAPI\Entities
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class InlineQueryResult extends Type {

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


    /**
     * @return string
     */
    abstract public function getType();
}
