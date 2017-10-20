<?php

namespace TelegramBotAPI\Types;


/**
 * @package TelegramBotAPI\Types
 * @link https://core.telegram.org/bots/api#maskposition
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class MaskPosition extends Type {

    /**
     * @var string $point
     */
    private $point;

    /**
     * @var float $xShift
     */
    private $xShift;

    /**
     * @var float $yShift
     */
    private $yShift;

    /**
     * @var float $zoom
     */
    private $zoom;


    /**
     * @return string
     */
    public function getPoint() {
        return $this->point;
    }

    /**
     * @param string $point
     */
    public function setPoint($point) {
        $this->point = $point;
    }

    /**
     * @return float
     */
    public function getXShift() {
        return $this->xShift;
    }

    /**
     * @param float $xShift
     */
    public function setXShift($xShift) {
        $this->xShift = $xShift;
    }

    /**
     * @return float
     */
    public function getYShift() {
        return $this->yShift;
    }

    /**
     * @param float $yShift
     */
    public function setYShift($yShift) {
        $this->yShift = $yShift;
    }

    /**
     * @return float
     */
    public function getZoom() {
        return $this->zoom;
    }

    /**
     * @param float $zoom
     */
    public function setZoom($zoom) {
        $this->zoom = $zoom;
    }
}
