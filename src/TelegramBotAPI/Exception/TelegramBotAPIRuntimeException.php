<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

namespace TelegramBotAPI\Exception;


use TelegramBotAPI\Types\ResponseParameters;

/**
 * Class TelegramBotAPIRuntimeException
 * @package TelegramBotAPI\Exception
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class TelegramBotAPIRuntimeException extends TelegramBotAPIException {

    /**
     * @var ResponseParameters $responseParameters
     */
    private $responseParameters;


    /**
     * @return ResponseParameters
     */
    public function getResponseParameters() {
        return $this->responseParameters;
    }

    /**
     * @param ResponseParameters $responseParameters
     */
    public function setResponseParameters($responseParameters) {
        $this->responseParameters = $responseParameters;
    }
}
