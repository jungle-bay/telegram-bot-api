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
 * Trait DescriptionTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait DescriptionTrait {

    /**
     * @var null|string $description
     */
    protected $description;


    /**
     * @return null|string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }
}
