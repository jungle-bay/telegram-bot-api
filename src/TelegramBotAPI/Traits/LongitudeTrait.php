<?php

namespace TelegramBotAPI\Traits;


trait LongitudeTrait {


    /**
     * @var float $longitude
     */
    protected $longitude;


    /**
     * @api
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @api
     * @param float $longitude
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
}
