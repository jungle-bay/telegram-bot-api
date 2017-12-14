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
 * Class UserProfilePhotos
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#userprofilephotos
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class UserProfilePhotos extends Type {

    /**
     * @var int $totalCount
     */
    private $totalCount;

    /**
     * @var PhotoSize[][] $photos
     */
    private $photos;


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
