<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#gamehighscore
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class GameHighScore extends Type {

    /**
     * @var int $position
     */
    private $position;

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var int $score
     */
    private $score;


    /**
     * @return int
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position) {
        $this->position = $position;
    }

    /**
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore($score) {
        $this->score = $score;
    }
}
