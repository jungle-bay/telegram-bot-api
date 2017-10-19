<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\InlineQueryResult\Traits\DescriptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbHeightTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbUrlTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthAndHeight;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultArticle extends InlineQueryResult {

    use TitleTrait;
    use DescriptionTrait;
    use ThumbUrlTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;
    use InputMessageContentTrait;


    /**
     * @var null|string $url
     */
    private $url;

    /**
     * @var null|bool $hideUrl
     */
    private $hideUrl;


    /**
     * @return string
     */
    public function getType() {
        return 'article';
    }

    /**
     * @return null|string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return bool|null
     */
    public function getHideUrl() {
        return $this->hideUrl;
    }

    /**
     * @param bool|null $hideUrl
     */
    public function setHideUrl($hideUrl) {
        $this->hideUrl = $hideUrl;
    }
}
