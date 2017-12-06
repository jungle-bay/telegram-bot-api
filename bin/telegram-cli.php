#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 15:06
 */

#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 09.11.17
 * Time: 17:51
 */

require_once(__DIR__ . '/phpConfig.php');
require_once(__DIR__ . '/../vendor/autoload.php');

$config = json_decode(file_get_contents(__DIR__ . '/../src/TelegramBot/Config/production.json'), true);

if ($config === null) throw new InvalidArgumentException('Not config file!');

$tba = new \TelegramBotAPI\TelegramBotAPI($config['bot']['token']);

try {

    $tba->deleteWebhook();

    $tba->setWebhook(array(
        'url' => $config['bot']['url']
    ));

} catch (\TelegramBotAPI\Exception\TelegramBotAPIRuntimeException $error) {

} catch (\TelegramBotAPI\Exception\TelegramBotAPIException $error) {

}

#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <sommelier.jungle@gmail.com>
 * Date: 12.06.17
 * Time: 23:26
 */

require_once(__DIR__ . '/phpConfig.php');
require_once(__DIR__ . '/../vendor/autoload.php');

$config = json_decode(file_get_contents(__DIR__ . '/../src/TelegramBot/Config/development.json'), true);

if ($config === null) throw new InvalidArgumentException('Not config file!');

$tba = new \TelegramBotAPI\TelegramBotAPI($config['bot']['token']);

try {

    $tba->deleteWebhook();

} catch (\TelegramBotAPI\Exception\TelegramBotAPIRuntimeException $error) {

}

$offset = null;

while (true) {

    try {

        $updates = $tba->getUpdates(array(
            'offset' => ($offset === null) ? $offset : ($offset + 1)
        ));

        $cUrl = curl_init('127.0.0.1:8989/bot' . $config['bot']['token'] . '/');

        $content = json_encode(array(
            'ok'     => true,
            'result' => $updates
        ));

        curl_setopt_array($cUrl, array(
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($content)
            ),
            CURLOPT_POSTFIELDS     => $content
        ));

        curl_exec($cUrl);

        $status = curl_getinfo($cUrl, CURLINFO_HTTP_CODE);

        if ($status !== 200) throw new RuntimeException (curl_error($cUrl) . ' status: ' . curl_errno($cUrl));

        curl_close($cUrl);

        if (count($updates) >= 1) {

            $update = array_pop($updates);

            $offset = $update->getUpdateId();
        }

        unset($updates);
        unset($request);
        unset($update);

        gc_collect_cycles();

        echo 'get update : ' . date('H:i:s') . PHP_EOL;

    } catch (\TelegramBotAPI\Exception\TelegramBotAPIRuntimeException $error) {

    } catch (\TelegramBotAPI\Exception\TelegramBotAPIException $error) {

    }

    sleep(5);
}
