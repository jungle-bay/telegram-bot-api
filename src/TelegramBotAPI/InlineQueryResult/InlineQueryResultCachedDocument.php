<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Core\InlineQueryResult;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\InlineQueryResult\Traits\DescriptionTrait;
use TelegramBotAPI\InlineQueryResult\Traits\InputMessageContentTrait;
use TelegramBotAPI\InlineQueryResult\Traits\TitleTrait;
use TelegramBotAPI\InlineQueryResult\Traits\CaptionTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultcacheddocument
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultCachedDocument extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;

    /**
     * @var string $documentFileId
     */
    private $documentFileId;


    /**
     * @return string
     */
    public function getType() {
        return 'document';
    }

    /**
     * @return string
     */
    public function getDocumentFileId() {
        return $this->documentFileId;
    }

    /**
     * @param string $documentFileId
     */
    public function setDocumentFileId($documentFileId) {
        $this->documentFileId = $documentFileId;
    }
}
