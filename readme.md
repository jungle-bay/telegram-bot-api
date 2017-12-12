<p align="center">
    <a href="https://github.com/jungle-bay/telegram-bot-api">
        <img width="128" height="128" src="logo.png" alt="Telegram Bot API Logo">
    </a>
</p>

# Telegram Bot API

[![Travis CI](https://img.shields.io/travis/jungle-bay/telegram-bot-api.svg?style=flat)](https://travis-ci.org/jungle-bay/telegram-bot-api)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/jungle-bay/telegram-bot-api.svg?style=flat)](https://scrutinizer-ci.com/g/jungle-bay/telegram-bot-api)
[![Codecov](https://img.shields.io/codecov/c/github/jungle-bay/telegram-bot-api.svg?style=flat)](https://codecov.io/gh/jungle-bay/telegram-bot-api)

This is PHP Library for [Telegram Bot API](https://core.telegram.org/bots). <br />
You can follow [this](https://core.telegram.org/bots/api) documentation to work with the library.

### Prerequisites

   - PHP 5.5 or above.
   - [curl](https://secure.php.net/manual/en/book.curl.php), [json](https://secure.php.net/manual/en/book.json.php) extensions must be enabled.

### Install

The recommended way to install is through [Composer](https://getcomposer.org/doc/00-intro.md#introduction):

```bash
composer require jungle-bay/telegram-bot-api
```

### The simplest example of use

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

// parameter is your bot token.
$tba = new \TelegramBotAPI\TelegramBotAPI('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11');

$botInfo = $tba->getMe();

echo 'Hello world! Im bot ' . $botInfo->getFirstName() . ' !';
```

### Note

* The basis for your bot can use [Telegram Bot Platform](https://github.com/jungle-bay/telegram-bot-platform).
* For the convenience of development, you can use [Telegram Bot CLI](https://github.com/jungle-bay/telegram-bot-cli).

### License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: [here](https://github.com/jungle-bay/telegram-bot-api/blob/master/license.txt).
