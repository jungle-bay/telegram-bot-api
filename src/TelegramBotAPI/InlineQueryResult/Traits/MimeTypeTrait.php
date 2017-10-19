<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


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

        if (($mimeType !== Constants::APPLICATION_PDF_MIME_TYPE) || ($mimeType !== Constants::APPLICATION_ZIP_MIME_TYPE)) {
            throw new TelegramBotAPIException('Mime type of the content of the file, either “application/pdf” or “application/zip”');
        }

        $this->mimeType = $mimeType;
    }
}
