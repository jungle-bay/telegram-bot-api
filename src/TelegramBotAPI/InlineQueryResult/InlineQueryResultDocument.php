<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\MimeTypeTrait;
use TelegramBotAPI\Traits\ThumbHeightTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\ThumbWidthTrait;
use TelegramBotAPI\Traits\TitleTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultDocument extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;
    use ThumbUrlTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;
    use MimeTypeTrait;


    /**
     * @var string $documentUrl
     */
    private $documentUrl;


    /**
     * @return string
     */
    public function getType() {
        return 'document';
    }

    /**
     * @return string
     */
    public function getDocumentUrl() {
        return $this->documentUrl;
    }

    /**
     * @param string $documentUrl
     */
    public function setDocumentUrl($documentUrl) {
        $this->documentUrl = $documentUrl;
    }
}
