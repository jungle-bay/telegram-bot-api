<?php

namespace TelegramBotAPI\Api;


/**
 * @package TelegramBotAPI\Api
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
interface JsonDeserializer {

    /**
     * In the object's constructor, need to implement convert from an array to an object.
     *
     * @param array $data
     */
    public function __construct(array $data = array());
}
