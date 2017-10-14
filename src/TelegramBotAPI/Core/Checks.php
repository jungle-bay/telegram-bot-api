<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Types\InputFile;
use TelegramBotAPI\Types\LabeledPrice;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\ForceReply;
use TelegramBotAPI\Types\ReplyKeyboardRemove;
use TelegramBotAPI\Types\ReplyKeyboardMarkup;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Constants;
use TelegramBotAPI\Exception\TelegramBotAPIWarning;

class Checks {

    /**
     * @param array $parameters
     * @param array $fields
     * @return array
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    protected function checkParameterToSend(array $parameters, array $fields) {

        $payload = array();

        foreach ($fields as $field => $howCheck) {

            switch ($howCheck) {

                case PrivateConst::CHECK_REQUIRED:
                    if (empty($parameters[$field])) {
                        throw new TelegramBotAPIException($field . ' is required field.');
                    }

                    $payload[$field] = $parameters[$field];
                    break;

                case PrivateConst::CHECK_PARSE_MODE_TYPE:
                    if (isset($parameters[$field])) {

                        if (!$this->checkParseModeType($parameters[$field])) {
                            new TelegramBotAPIWarning('
                            Used not by the correct parse mode.
                            Send Markdown or HTML, if you want Telegram apps to show bold, italic,
                            fixed-width text or inline URLs in your bot\'s message.
                        ');
                        }

                        $payload[$field] = $parameters[$field];
                    }

                    break;

                case PrivateConst::CHECK_KEYBOARD_TYPE:
                    if (isset($parameters[$field])) {
                        if (!$this->checkKeyboardType($parameters[$field])) {
                            new TelegramBotAPIWarning('Invalid keyboard type.');
                        }

                        $payload[$field] = json_encode($parameters[$field]);
                    }
                    break;

                case PrivateConst::CHECK_ACTION_TYPE:
                    if (isset($parameters[$field])) {
                        if (!$this->checkActionType($parameters[$field])) {
                            new TelegramBotAPIWarning('Invalid action type.');
                        }

                        $payload[$field] = $parameters[$field];
                    }
                    break;

                case PrivateConst::CHECK_LIMIT:
                    if (isset($parameters[$field])) {
                        if (!$this->checkLimit($parameters[$field])) {
                            new TelegramBotAPIWarning('
                            Used not by the correct limit limits the number of updates that are updated.
                            Values from 1 to 100 are accepted. Default is 100.
                        ');
                        }

                        $payload[$field] = $parameters[$field];
                    }
                    break;

                case PrivateConst::CHECK_CAPTION_LIMIT:
                    if (isset($parameters[$field])) {
                        if (!$this->checkCaptionLimit($parameters[$field])) {
                            new TelegramBotAPIWarning('
                            Used not by the correct limit.
                            Photo caption (may also be used when resending photos by file_id),
                            0-200 characters.
                        ');
                        }

                        $payload[$field] = $parameters[$field];
                    }
                    break;

                case PrivateConst::CHECK_LOCATION:
                    if (isset($parameters[$field])) {
                        if (!$this->checkLocalLimit($parameters[$field])) {
                            new TelegramBotAPIWarning('
                                Period in seconds for which the location will be updated
                                (see Live Locations, should be between 60 and 86400)
                        ');
                        }

                        $payload[$field] = $parameters[$field];
                    }
                    break;

                default:
                    if (isset($parameters[$field])) {
                        $payload[$field] = $parameters[$field];
                    }

                    break;

            }
        }

        return $payload;
    }

    /**
     * @param string $response
     * @return bool|array
     * @throws TelegramBotAPIRuntimeException
     */
    protected function checkForBadRequest($response) {

        $data = json_decode($response, true);

        if ($data === null) {
            throw new TelegramBotAPIRuntimeException('I can not spread the answer', HTTP::INTERNAL_SERVER_ERROR);
        }

        if ($data['ok'] !== true) {
            throw new TelegramBotAPIRuntimeException($data['description'], $data['error_code']);
        }

        return $data['result'];
    }

    /**
     * @param $keyboard
     * @return bool
     */
    protected function checkKeyboardType($keyboard) {

        switch (true) {

            case $keyboard instanceof InlineKeyboardMarkup:
            case $keyboard instanceof ReplyKeyboardMarkup:
            case $keyboard instanceof ReplyKeyboardRemove:
            case $keyboard instanceof ForceReply:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param string $actionType
     * @return bool
     */
    protected function checkActionType($actionType) {

        switch ($actionType) {

            case Constants::TYPING_TYPE_ACTION:
            case Constants::UPLOAD_PHOTO_TYPE_ACTION:
            case Constants::RECORD_VIDEO_TYPE_ACTION:
            case Constants::UPLOAD_VIDEO_TYPE_ACTION:
            case Constants::RECORD_AUDIO_TYPE_ACTION:
            case Constants::UPLOAD_AUDIO_TYPE_ACTION:
            case Constants::UPLOAD_DOCUMENT_TYPE_ACTION:
            case Constants::FIND_LOCATION_TYPE_ACTION:
            case Constants::RECORD_VIDEO_NOTE:
            case Constants::UPLOAD_VIDEO_NOTE:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param string $caption
     * @return bool
     */
    protected function checkCaptionLimit($caption) {

        $len = strlen($caption);

        return (($len > PrivateConst::CAPTION_MIN_SIZE) && (PrivateConst::CAPTION_MAX_SIZE > $len));
    }

    /**
     * @param int $limit
     * @return bool
     */
    protected function checkLimit($limit) {
        return (($limit > PrivateConst::LIMIT_MIN) && (PrivateConst::LIMIT_MAX < $limit));
    }

    /**
     * @param int $limit
     * @return bool
     */
    protected function checkLocalLimit($limit) {
        return (($limit > PrivateConst::CHECK_LOCATION_MIN) && (PrivateConst::CHECK_LOCATION_MAX < $limit));
    }

    /**
     * @param string $mode
     * @return bool
     */
    protected function checkParseModeType($mode) {
        return ((Constants::HTML_PARSE_MODE === $mode) || (Constants::MARKDOWN_PARSE_MODE === $mode));
    }
}
