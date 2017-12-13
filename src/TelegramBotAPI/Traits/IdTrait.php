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
 * Trait IdTrait
 * @package TelegramBotAPI\Traits
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait IdTrait {

    /**
     * @var string $id
     */
    protected $id;


    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }
}
