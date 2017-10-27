<?php

namespace TelegramBotAPI\InlineQueryResult;


/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultGame extends InlineQueryResult {

    /**
     * @var string
     */
    private $type = 'game';

    /**
     * @var string $type
     */
    private $gameShortName;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getGameShortName() {
        return $this->gameShortName;
    }

    /**
     * @param string $gameShortName
     */
    public function setGameShortName($gameShortName) {
        $this->gameShortName = $gameShortName;
    }
}
