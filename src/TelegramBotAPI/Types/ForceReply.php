<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Core\Type;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#forcereply
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class ForceReply extends Type {

    /**
     * @var bool $forceReply
     */
    private $forceReply;

    /**
     * @var null|bool $selective
     */
    private $selective;


    /**
     * @return bool
     */
    public function getForceReply() {
        return $this->forceReply;
    }

    /**
     * @param bool $forceReply
     */
    public function setForceReply($forceReply) {
        $this->forceReply = $forceReply;
    }

    /**
     * @return bool|null
     */
    public function getSelective() {
        return $this->selective;
    }

    /**
     * @param bool|null $selective
     */
    public function setSelective($selective) {
        $this->selective = $selective;
    }
}
