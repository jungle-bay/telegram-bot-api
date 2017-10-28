<?php

namespace TelegramBotAPI\Supports\Gson;


/**
 * @package TelegramBotAPI\Supports\Gson
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
trait SerializableTrait {

    /**
     * @param string $value
     * @return string
     */
    private function unCamelize($value) {

        $value = preg_replace('/[A-Z]/', ' ${0}', $value);
        $value = str_replace(' ', '_', $value);

        return strtolower($value);
    }


    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() {

        $props = (array) $this;
        $json = array();

        foreach ($props as $key => $value) {

            if ($value === null) {
                continue;
            }

            if (substr($key, 1, 1) === '*') {
                $key = substr($key, 2);
            }

            $key = str_replace(get_called_class(), '', $key);
            $key = str_replace("\0", '', $key);

            $json[$this->unCamelize($key)] = $value;
        }

        unset($props);

        return $json;
    }
}
