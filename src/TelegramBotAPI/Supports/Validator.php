<?php

namespace TelegramBotAPI\Supports;


use TelegramBotAPI\Constants;
use TelegramBotAPI\Types\ForceReply;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIWarning;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Types\ReplyKeyboardMarkup;
use TelegramBotAPI\Types\ReplyKeyboardRemove;

class Validator {

    const LIMIT_MIN = 1;
    const LIMIT_MAX = 100;

    const CAPTION_SIZE_MIN = 1;
    const CAPTION_SIZE_MAX = 200;

    const LOCATION_MIN = 60;
    const LOCATION_MAX = 86400;

    const CHECK_TOKEN_PATTERN = '/^[0-9]{9}:[A-Za-z0-9\_\-]{35}$/';
    const SWITCH_PM_PARAM_PATTERN = '/^[0-9a-zA-Z\-\_]+$/';

    const CHECK_PARSE_MODE_TYPE = 'CHECK_PARSE_MODE_TYPE';
    const CHECK_KEYBOARD_TYPE = 'CHECK_KEYBOARD_TYPE';
    const CHECK_ACTION_TYPE = 'CHECK_ACTION_TYPE';
    const CHECK_LIMIT = 'CHECK_LIMIT';
    const CHECK_CAPTION_LIMIT = 'CHECK_CAPTION_LIMIT';
    const CHECK_NO_REQUIRED = 'CHECK_NO_REQUIRED';
    const CHECK_REQUIRED = 'CHECK_REQUIRED';
    const CHECK_LOCATION = 'CHECK_LOCATION';

    private function checkRequired(array $parameters, $key) {

        if (!isset($parameters[$key])) {
            throw new TelegramBotAPIException($key . ' is required field.');
        }

        return $parameters[$key];
    }

    private function checkNoRequired(array $parameters, $key) {

        if (!isset($parameters[$key])) {
            return null;
        }

        return $parameters[$key];
    }

    protected function checkLimit($limit) {

        $isOK = ((self::LIMIT_MIN < $limit) && ($limit < self::LIMIT_MAX));

        if (!$isOK) {
            new TelegramBotAPIWarning('Values from 1 to 100 are accepted. Default is 100.');

            return null;
        }

        return $limit;
    }

    protected function checkLocal($local) {

        $isOK = ((self::LOCATION_MIN < $local) && ($local < self::LOCATION_MAX));

        if (!$isOK) {
            new TelegramBotAPIWarning('See Live Locations, should be between 60 and 86400.');

            return null;
        }

        return $local;
    }

    protected function checkCaptionLimit($caption) {

        $length = strlen($caption);
        $isOK = ((self::CAPTION_SIZE_MIN < $length) && ($length < self::CAPTION_SIZE_MAX));

        if (!$isOK) {
            new TelegramBotAPIWarning('Values from 0 to 200 are characters.');

            return null;
        }

        return $caption;
    }

    protected function checkKeyboardType($keyboard) {

        switch (true) {

            case $keyboard instanceof InlineKeyboardMarkup:
            case $keyboard instanceof ReplyKeyboardMarkup:
            case $keyboard instanceof ReplyKeyboardRemove:
            case $keyboard instanceof ForceReply:
                return json_encode($keyboard);
            default:
                return null;
        }
    }

    protected function checkActionType($actionType) {

        switch ($actionType) {

            case Constants::RECORD_VIDEO_NOTE:
            case Constants::UPLOAD_VIDEO_NOTE:
            case Constants::TYPING_TYPE_ACTION:
            case Constants::UPLOAD_PHOTO_TYPE_ACTION:
            case Constants::RECORD_VIDEO_TYPE_ACTION:
            case Constants::UPLOAD_VIDEO_TYPE_ACTION:
            case Constants::RECORD_AUDIO_TYPE_ACTION:
            case Constants::UPLOAD_AUDIO_TYPE_ACTION:
            case Constants::FIND_LOCATION_TYPE_ACTION:
            case Constants::UPLOAD_DOCUMENT_TYPE_ACTION:
                return $actionType;
            default:
                new TelegramBotAPIWarning('Invalid action type.');

                return null;
        }
    }

    protected function checkParseModeType($mode) {

        $isOK = ((Constants::HTML_PARSE_MODE === $mode) || (Constants::MARKDOWN_PARSE_MODE === $mode));

        if (!$isOK) {
            new TelegramBotAPIWarning('Send Markdown or HTML.');

            return null;
        }

        return $mode;
    }

    private function checkValue(array $parameters, $key, $check) {

        if ($check === self::CHECK_REQUIRED) {
            return $this->checkRequired($parameters, $key);
        }

        if ($check === self::CHECK_NO_REQUIRED) {
            return $this->checkNoRequired($parameters, $key);
        }

        return null;
    }

    private function checkObj(array $parameters, $key, array $check) {

        $obj = $this->checkValue($parameters, $key, $check['required']);

        if ($obj === null) {
            return null;
        }

        switch ($check['type']) {

            case self::CHECK_PARSE_MODE_TYPE:
                return $this->checkParseModeType($parameters[$key]);

            case self::CHECK_KEYBOARD_TYPE:
                return $this->checkKeyboardType($parameters[$key]);

            case self::CHECK_ACTION_TYPE:
                return $this->checkActionType($parameters[$key]);

            case self::CHECK_LIMIT:
                return $this->checkLimit($parameters[$key]);

            case self::CHECK_CAPTION_LIMIT:
                return $this->checkCaptionLimit($parameters[$key]);

            case self::CHECK_LOCATION:
                return $this->checkLocal($parameters[$key]);

            default:
                return $obj;
        }
    }

    public function validator(array $parameters, array $scheme) {

        $payload = array();

        foreach ($scheme as $key => $check) {

            if (is_array($check)) {
                $obj = $this->checkObj($parameters, $key, $check);
            } else {
                $obj = $this->checkValue($parameters, $key, $check);
            }

            if ($obj !== null) {
                $payload[$key] = $obj;
            }
        }

        return $payload;
    }
}
