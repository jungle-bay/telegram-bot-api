<?php

namespace TelegramBotAPI\Traits;


use TelegramBotAPI\Supports\Validator;

trait ParametersTrait {

    /**
     * @var Validator $validator
     */
    private $validator;


    /**
     * @param array $parameters
     * @param array $scheme
     * @return array
     */
    protected function getParameters(array $parameters, array $scheme) {

        if ($this->validator === null) {
            $this->validator = new Validator();
        }

        $parameters = $this->validator->validator($parameters, $scheme);

        return $parameters;
    }
}
