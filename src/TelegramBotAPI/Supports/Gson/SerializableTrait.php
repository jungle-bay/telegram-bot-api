<?php

namespace TelegramBotAPI\Supports\Gson;


trait SerializableTrait {

    private function unCamelize($value) {

        $value = preg_replace('/[A-Z]/', ' ${0}', $value);
        $value = str_replace(' ', '_', $value);

        return strtolower($value);
    }


    public function jsonSerialize() {

        $props = (array) $this;
        //$props = array_filter($props);
        $json = array();

        foreach ($props as $key => $value) {

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
