<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\LatitudeTrait;
use TelegramBotAPI\InlineQueryResult\Traits\LongitudeTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbHeightTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbUrlTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthAndHeight;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultLocation extends InlineQueryResult {

    use TitleTrait;
    use InputMessageContentTrait;
    use ThumbUrlTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;
    use LongitudeTrait;
    use LatitudeTrait;


    /**
     * @return string
     */
    public function getType() {
        return 'location';
    }
}
