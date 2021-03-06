<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\InputMessageContent;


use TelegramBotAPI\Constants;
use TelegramBotAPI\Exception\TelegramBotAPIException;

/**
 * Class InputTextMessageContent
 * @package TelegramBotAPI\InputMessageContent
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class InputTextMessageContent extends InputMessageContent {

    const MESSAGE_MIN_SIZE = 0;
    const MESSAGE_MAX_SIZE = 4096;


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

        if (($size > self::MESSAGE_MIN_SIZE) && ($size > self::MESSAGE_MAX_SIZE)) {
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

        if (($parseMode === Constants::HTML_PARSE_MODE) || ($parseMode === Constants::MARKDOWN_PARSE_MODE)) {
            $this->parseMode = $parseMode;

            return;
        }

        throw new TelegramBotAPIException('Send “Markdown“ or “HTML“');
    }

    /**
     * @return bool|null
     */
    public function isDisableWebPagePreview() {
        return $this->disableWebPagePreview;
    }

    /**
     * @param bool $disableWebPagePreview
     */
    public function setDisableWebPagePreview($disableWebPagePreview) {
        $this->disableWebPagePreview = $disableWebPagePreview;
    }
}
