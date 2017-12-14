<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Types;


/**
 * Class ForceReply
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
    public function isForceReply() {
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
    public function isSelective() {
        return $this->selective;
    }

    /**
     * @param bool|null $selective
     */
    public function setSelective($selective) {
        $this->selective = $selective;
    }
}
