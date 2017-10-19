<?php

namespace TelegramBotAPI;


use TelegramBotAPI\Core\HTTP;
use TelegramBotAPI\Traits\GamesTrait;
use TelegramBotAPI\Traits\StickersTrait;
use TelegramBotAPI\Traits\PaymentsTrait;
use TelegramBotAPI\Traits\InlineModeTrait;
use TelegramBotAPI\Traits\GettingUpdatesTrait;
use TelegramBotAPI\Traits\AvailableMethodsTrait;
use TelegramBotAPI\Traits\UpdatingMessagesTrait;

/**
 * @package TelegramBotAPI
 * @link https://core.telegram.org/bots/api
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPI extends HTTP {

    use GettingUpdatesTrait;
    use AvailableMethodsTrait;
    use UpdatingMessagesTrait;
    use StickersTrait;
    use InlineModeTrait;
    use PaymentsTrait;
    use GamesTrait;
}
