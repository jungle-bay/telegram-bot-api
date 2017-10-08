<?php

namespace TelegramBotAPI\Types;


use TelegramBotAPI\Api\JsonDeserializer;

/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#userprofilephotos
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class UserProfilePhotos implements JsonDeserializer {

    /**
     * @var int $totalCount
     */
    private $totalCount;

    /**
     * @var array PhotoSize[] $photos
     */
    private $photos;


    /**
     * @param array $data
     */
    public function __construct(array $data = array()) {

        $this->setTotalCount($data['total_count']);

        $photos = array();

        foreach ($data['photos'] as $photo) {
            foreach ($photo as $image) {
                $photos[] = new PhotoSize($image);
            }
        }

        $this->setPhotos($photos);
    }

    /**
     * @return int
     */
    public function getTotalCount() {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     */
    public function setTotalCount($totalCount) {
        $this->totalCount = $totalCount;
    }

    /**
     * @return array PhotoSize[]
     */
    public function getPhotos() {
        return $this->photos;
    }

    /**
     * @param array PhotoSize[] $photos
     */
    public function setPhotos($photos) {
        $this->photos = $photos;
    }
}
