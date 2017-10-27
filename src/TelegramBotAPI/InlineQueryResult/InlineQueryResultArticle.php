<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\ThumbHeightTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\ThumbWidthTrait;
use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

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
     * @var string
     */
    private $type = 'article';

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
        return $this->type;
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
