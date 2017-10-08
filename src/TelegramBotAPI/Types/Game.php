<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializerInterface;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#game
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class Game implements JsonDeserializerInterface {

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
     * @var null|Message[] $textEntities
     */
    private $textEntities;

    /**
     * @var null|Animation $animation
     */
    private $animation;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setTitle($data['title']);
        $this->setDescription($data['description']);

        $photos = array();

        foreach ($data['photo'] as $photo) $photos[] = new PhotoSize($photo);;

        $this->setPhoto($photos);

        if (isset($data['text'])) $this->setText($data['text']);

        if (isset($data['text_entities'])) {

            $entities = array();

            foreach ($data['text_entities'] as $message) $entities[] = new Message($message);

            $this->setTextEntities($entities);
        }

        if (isset($data['animation'])) $this->setAnimation(new Animation($data['animation']));
    }

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
     * @return null|Message[]
     */
    public function getTextEntities() {
        return $this->textEntities;
    }

    /**
     * @param null|Message[] $textEntities
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
