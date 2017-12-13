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
 * Trait ThumbUrlTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait ThumbUrlTrait {

    /**
     * @var string|null $thumbUrl
     */
    protected $thumbUrl;


    /**
     * @return string
     */
    public function getThumbUrl() {
        return $this->thumbUrl;
    }

    /**
     * @param string $thumbUrl
     */
    public function setThumbUrl($thumbUrl) {
        $this->thumbUrl = $thumbUrl;
    }
}
