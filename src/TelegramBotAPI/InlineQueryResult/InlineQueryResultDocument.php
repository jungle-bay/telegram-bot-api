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
use TelegramBotAPI\Traits\MimeTypeTrait;
use TelegramBotAPI\Traits\ThumbUrlTrait;
use TelegramBotAPI\Traits\ThumbWidthTrait;
use TelegramBotAPI\Traits\DescriptionTrait;
use TelegramBotAPI\Traits\ThumbHeightTrait;
use TelegramBotAPI\Traits\InputMessageContentTrait;

/**
 * @package TelegramBotAPI\InlineQueryResult
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InlineQueryResultDocument extends InlineQueryResult {

    use TitleTrait;
    use CaptionTrait;
    use ThumbUrlTrait;
    use MimeTypeTrait;
    use ThumbWidthTrait;
    use ThumbHeightTrait;
    use DescriptionTrait;
    use InputMessageContentTrait;


    /**
     * @var string $type
     */
    private $type = 'document';

    /**
     * @var string $documentUrl
     */
    private $documentUrl;


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
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
