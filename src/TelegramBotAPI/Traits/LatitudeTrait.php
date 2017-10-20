<?php

namespace TelegramBotAPI\Traits;


trait LatitudeTrait {

    /**
     * @var float $latitude
     */
    protected $latitude;


    /**
     * @return float
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

}
