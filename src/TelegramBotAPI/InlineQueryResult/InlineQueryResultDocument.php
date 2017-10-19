<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\Constants;
use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\DescriptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\MimeTypeTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbHeightTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbUrlTrait;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthAndHeight;
use TelegramBotAPI\InlineQueryResult\Traits\ThumbWidthTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Exception\TelegramBotAPIException;

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
