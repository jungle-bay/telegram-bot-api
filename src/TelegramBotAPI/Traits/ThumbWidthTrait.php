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
 * Trait ThumbWidthTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait ThumbWidthTrait {

    /**
     * @var null|int $thumbWidth
     */
    protected $thumbWidth;


    /**
     * @return int|null
     */
    public function getThumbWidth() {
        return $this->thumbWidth;
    }

    /**
     * @param int|null $thumbWidth
     */
    public function setThumbWidth($thumbWidth) {
        $this->thumbWidth = $thumbWidth;
    }
}
