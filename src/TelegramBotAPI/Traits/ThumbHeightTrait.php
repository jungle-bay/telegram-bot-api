<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Traits;


/**
 * Trait ThumbHeightTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait ThumbHeightTrait {

    /**
     * @var null|int $thumbHeight
     */
    protected $thumbHeight;


    /**
     * @return int|null
     */
    public function getThumbHeight() {
        return $this->thumbHeight;
    }

    /**
     * @param int|null $thumbHeight
     */
    public function setThumbHeight($thumbHeight) {
        $this->thumbHeight = $thumbHeight;
    }
}
