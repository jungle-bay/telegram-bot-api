<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\LatitudeTrait;
use TelegramBotAPI\Traits\LongitudeTrait;
use TelegramBotAPI\Traits\ThumbHeightTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\ThumbWidthTrait;
use TelegramBotAPI\Traits\TitleTrait;

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
