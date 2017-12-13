<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace TelegramBotAPI\InlineQueryResult;


use TelegramBotAPI\Traits\TitleTrait;
use TelegramBotAPI\Traits\CaptionTrait;
use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

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
     * @var string $type
     */
    private $type = 'document';

    /**
     * @var string $documentFileId
     */
    private $documentFileId;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
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
