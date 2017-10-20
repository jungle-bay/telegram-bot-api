<?php

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;
use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;

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
