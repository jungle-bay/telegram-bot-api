<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultGame extends InlineQueryResult {

    /**
     * @var string $type
     */
    private $gameShortName;


    /**
     * @return string
     */
    public function getType() {
        return 'game';
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
