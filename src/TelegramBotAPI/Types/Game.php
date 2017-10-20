<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#game
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Game extends Type {

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var PhotoSize[] $photo
     */
    private $photo;

    /**
     * @var null|string $text
     */
    private $text;

    /**
     * @var null|MessageEntity[] $textEntities
     */
    private $textEntities;

    /**
     * @var null|Animation $animation
     */
    private $animation;


    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return PhotoSize[]
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * @param PhotoSize[] $photo
     */
    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    /**
     * @return null|string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param null|string $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return null|MessageEntity[]
     */
    public function getTextEntities() {
        return $this->textEntities;
    }

    /**
     * @param null|MessageEntity[] $textEntities
     */
    public function setTextEntities($textEntities) {
        $this->textEntities = $textEntities;
    }

    /**
     * @return null|Animation
     */
    public function getAnimation() {
        return $this->animation;
    }

    /**
     * @param null|Animation $animation
     */
    public function setAnimation($animation) {
        $this->animation = $animation;
    }
}
