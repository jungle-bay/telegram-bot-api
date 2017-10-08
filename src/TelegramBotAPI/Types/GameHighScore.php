<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#gamehighscore
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class GameHighScore implements JsonDeserializerInterface {

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
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setPosition($data['position']);
        $this->setUser($data['user']);
        $this->setScore($data['score']);
    }

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
