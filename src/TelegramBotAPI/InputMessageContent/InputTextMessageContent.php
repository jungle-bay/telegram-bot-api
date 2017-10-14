<?php

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Constants as TBAConstPublic;
use TelegramBotAPI\Core\InputMessageContent;
use TelegramBotAPI\PrivateConst as TBAConstPrivate;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputTextMessageContent extends InputMessageContent {

    /**
     * @var string $messageText
     */
    private $messageText;

    /**
     * @var null|string $parseMode
     */
    private $parseMode;

    /**
     * @var null|bool $disableWebPagePreview
     */
    private $disableWebPagePreview;


    /**
     * @return string
     */
    public function getMessageText() {
        return $this->messageText;
    }

    /**
     * @param string $messageText
     * @throws TelegramBotAPIException
     */
    public function setMessageText($messageText) {

        if (empty($messageText)) {
            throw new TelegramBotAPIException('Text of the message not must be null');
        }

        $size = strlen($messageText);

        if (($size > TBAConstPrivate::MESSAGE_MIN_SIZE) && ($size > TBAConstPrivate::MESSAGE_MAX_SIZE)) {
            throw new TelegramBotAPIException('Text of the message to be sent, 1-4096 characters');
        }

        $this->messageText = $messageText;
    }

    /**
     * @return null|string
     */
    public function getParseMode() {
        return $this->parseMode;
    }

    /**
     * @param string $parseMode
     * @throws TelegramBotAPIException
     */
    public function setParseMode($parseMode) {

        if (($parseMode !== TBAConstPublic::HTML_PARSE_MODE) || ($parseMode !== TBAConstPublic::MARKDOWN_PARSE_MODE)) {
            throw new TelegramBotAPIException('Send “Markdown“ or “HTML“');
        }

        $this->parseMode = $parseMode;
    }

    /**
     * @return bool|null
     */
    public function getDisableWebPagePreview() {
        return $this->disableWebPagePreview;
    }

    /**
     * @param bool $disableWebPagePreview
     */
    public function setDisableWebPagePreview($disableWebPagePreview) {
        $this->disableWebPagePreview = $disableWebPagePreview;
    }
}
