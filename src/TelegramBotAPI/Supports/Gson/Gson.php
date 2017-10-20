<?php

namespace TelegramBotAPI\Supports\Gson;


use JsonSerializable;

/**
 * @package TelegramBotAPI\Supports\Gson
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
abstract class Gson implements JsonSerializable {

    use SerializableTrait;
    use DeserializerTrait;
}
