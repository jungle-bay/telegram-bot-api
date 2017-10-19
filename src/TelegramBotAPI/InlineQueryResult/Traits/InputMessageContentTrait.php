<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


use TelegramBotAPI\Core\InputMessageContent;

trait InputMessageContentTrait {

    /**
     * @var InputMessageContent $inputMessageContent
     */
    protected $inputMessageContent;


    /**
     * @return InputMessageContent
     */
    public function getInputMessageContent() {
        return $this->inputMessageContent;
    }

    /**
     * @param InputMessageContent $inputMessageContent
     */
    public function setInputMessageContent(InputMessageContent $inputMessageContent) {
        $this->inputMessageContent = $inputMessageContent;
    }
}
