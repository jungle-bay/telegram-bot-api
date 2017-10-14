<?php

namespace TelegramBotAPI\Core;


use TelegramBotAPI\Types\InputFile;
use TelegramBotAPI\Types\LabeledPrice;
use TelegramBotAPI\Constants;
use TelegramBotAPI\PrivateConst;
use TelegramBotAPI\Types\ForceReply;
use TelegramBotAPI\Types\ReplyKeyboardRemove;
use TelegramBotAPI\Types\ReplyKeyboardMarkup;
use TelegramBotAPI\Types\InlineKeyboardMarkup;
use TelegramBotAPI\Exception\TelegramBotAPIWarning;
use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;

class Checks {


    private function checkRequired($parameters, $key) {

        if (empty($parameters[$key])) {
            throw new TelegramBotAPIException($key . ' is required field.');
        }

        return $parameters[$key];
    }

    private function checkNoRequired($parameters, $key) {

        if (!isset($parameters[$key])) {
            return null;
        }

        return $parameters[$key];
    }


    /**
     * @param int $limit
     * @return bool
     */
    protected function checkLimit($limit) {

        $isOK = ((PrivateConst::LIMIT_MIN < $limit) && ($limit < PrivateConst::LIMIT_MAX));

        if (!$isOK) {
            new TelegramBotAPIWarning('Values from 1 to 100 are accepted. Default is 100.');

            return null;
        }

        return $limit;
    }

    /**
     * @param int $limit
     * @return bool
     */
    protected function checkLocalLimit($limit) {

        $isOK = ((PrivateConst::LOCATION_MIN < $limit) && ($limit < PrivateConst::LOCATION_MAX));

        if (!$isOK) {
            new TelegramBotAPIWarning('See Live Locations, should be between 60 and 86400.');

            return null;
        }

        return $limit;
    }

    /**
     * @param string $caption
     * @return bool
     */
    protected function checkCaptionLimit($caption) {

        $length = strlen($caption);
        $isOK = ((PrivateConst::CAPTION_SIZE_MIN < $length) && ($length < PrivateConst::CAPTION_SIZE_MAX));

        if (!$isOK) {
            new TelegramBotAPIWarning('Values from 0 to 200 are characters.');

            return null;
        }

        return $caption;
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
                return json_encode($keyboard);
            default:
                return null;
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
                return $actionType;
            default:
                new TelegramBotAPIWarning('Invalid action type.');

                return null;
        }
    }

    /**
     * @param string $mode
     * @return bool
     */
    protected function checkParseModeType($mode) {

        $isOK = ((Constants::HTML_PARSE_MODE === $mode) || (Constants::MARKDOWN_PARSE_MODE === $mode));

        if (!$isOK) {
            new TelegramBotAPIWarning('Send Markdown or HTML.');

            return null;
        }

        return $mode;
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
     * @param array $parameters
     * @param string $key
     * @param array $check
     * @return mixed|null
     */
    private function checkValue(array $parameters, $key, $check) {

        if ($check === PrivateConst::CHECK_REQUIRED) {
            return $this->checkRequired($parameters, $key);
        }

        if ($check === PrivateConst::CHECK_NO_REQUIRED) {
            return $this->checkNoRequired($parameters, $key);
        }

        return null;
    }

    /**
     * @param array $parameters
     * @param string $key
     * @param array $check
     * @return mixed|null
     */
    private function checkObj(array $parameters, $key, array $check) {

        $obj = $this->checkValue($parameters, $key, $check['required']);

        if ($obj === null) {
            return null;
        }

        switch ($check['type']) {

            case PrivateConst::CHECK_PARSE_MODE_TYPE:
                $obj = $this->checkParseModeType($parameters[$key]);
                break;

            case PrivateConst::CHECK_KEYBOARD_TYPE:
                $obj = $this->checkKeyboardType($parameters[$key]);
                break;

            case PrivateConst::CHECK_ACTION_TYPE:
                $obj = $this->checkActionType($parameters[$key]);
                break;

            case PrivateConst::CHECK_LIMIT:
                $obj = $this->checkLimit($parameters[$key]);
                break;

            case PrivateConst::CHECK_CAPTION_LIMIT:
                $obj = $this->checkCaptionLimit($parameters[$key]);
                break;

            case PrivateConst::CHECK_LOCATION:
                $obj = $this->checkLocalLimit($parameters[$key]);
                break;
        }

        return $obj;
    }

    /**
     * @param array $parameters
     * @param array $scheme
     * @return array
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    protected function checkParameter(array $parameters, array $scheme) {

        $payload = array();

        foreach ($scheme as $key => $check) {

            $obj = null;

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
