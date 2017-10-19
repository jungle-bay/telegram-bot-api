<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Exception\TelegramBotAPIException;
use TelegramBotAPI\Exception\TelegramBotAPIRuntimeException;
use TelegramBotAPI\PrivateConst;

trait InlineModeTrait {

    /**
     * @api
     * @link https://core.telegram.org/bots/api#answerinlinequery
     * @param array $parameters
     * @return bool
     *
     * @throws TelegramBotAPIException
     * @throws TelegramBotAPIRuntimeException
     */
    public function answerInlineQuery(array $parameters) {

        $payload = $this->checkParameter($parameters, array(
            'inline_query_id'     => PrivateConst::CHECK_REQUIRED,
            'results'             => PrivateConst::CHECK_REQUIRED,
            'cache_time'          => PrivateConst::CHECK_NO_REQUIRED,
            'is_personal'         => PrivateConst::CHECK_NO_REQUIRED,
            'next_offset'         => PrivateConst::CHECK_NO_REQUIRED,
            'switch_pm_text'      => PrivateConst::CHECK_NO_REQUIRED,
            'switch_pm_parameter' => PrivateConst::CHECK_NO_REQUIRED
        ));

        if (count($payload['results']) > 50) {
            throw new TelegramBotAPIException('No more than 50 results per query are allowed');
        }

        $payload['results'] = json_encode($payload['results']);

        if (!preg_match(PrivateConst::SWITCH_PM_PARAM_PATTERN, $payload['switch_pm_parameter'])) {
            throw new TelegramBotAPIException('Switch pm parameter only A-Z, a-z, 0-9, _ and - are allowed.');
        }

        $url = $this->generateUrl(PrivateConst::ANSWER_INLINE_QUERY);
        $result = (bool) $this->send(PrivateConst::POST, $url, $payload);

        unset($parameters, $url, $payload);

        return $result;
    }



}
