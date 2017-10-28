<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\LatitudeTrait;
use TelegramBotAPI\Traits\LongitudeTrait;
use TelegramBotAPI\Traits\ThumbWidthTrait;
use TelegramBotAPI\Traits\ThumbHeightTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultLocation extends InlineQueryResult {

    use TitleTrait;
    use ThumbUrlTrait;
    use LatitudeTrait;
    use LongitudeTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'location';


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }
}
