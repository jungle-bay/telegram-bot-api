<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Constants;
use TelegramBotAPI\Exception\TelegramBotAPIException;

trait MimeTypeTrait {

    /**
     * @var string $mimeType
     */
    protected $mimeType;


    /**
     * @return string
     */
    public function getMimeType() {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @throws TelegramBotAPIException
     */
    public function setMimeType($mimeType) {

        switch ($mimeType) {
            case Constants::APPLICATION_PDF_MIME_TYPE:
            case Constants::APPLICATION_ZIP_MIME_TYPE:
                $this->mimeType = $mimeType;

                return;
            default:
                throw new TelegramBotAPIException('Mime type of the content of the file, either “application/pdf” or “application/zip”');
        }
    }
}
