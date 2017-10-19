<?php

namespace TelegramBotAPI\InlineQueryResult\Traits;


trait LongitudeTrait {


    /**
     * @var float $longitude
     */
    protected $longitude;


    /**
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
}
