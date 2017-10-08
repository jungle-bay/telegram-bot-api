# Telegram Bot API

This is PHP Library for Telegram Bot API.
You can follow [this](https://core.telegram.org/bots/api "Telegram Bot API") documentation to work with the library.

[![Travis CI](https://img.shields.io/travis/jungle-mob/telegram-bot-api.svg?style=flat)](https://travis-ci.org/jungle-mob/telegram-bot-api)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/jungle-mob/telegram-bot-api.svg?style=flat)](https://scrutinizer-ci.com/g/jungle-mob/telegram-bot-api)
[![Codecov](https://img.shields.io/codecov/c/github/jungle-mob/telegram-bot-api.svg?style=flat)](https://codecov.io/gh/jungle-mob/telegram-bot-api)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/8d372f24-cfad-415d-ba77-38b604b6332d.svg?style=flat)](https://insight.sensiolabs.com/projects/8d372f24-cfad-415d-ba77-38b604b6332d)
[![Telegram chat](https://img.shields.io/badge/chat-on%20telegram-brightgreen.svg?style=flat)](https://t.me/joinchat/AAAAAD4GsKIh_AtPynuuIQ)

## Prerequisites

   - PHP 5.4.0 or above.
   - [curl](https://secure.php.net/manual/en/book.curl.php), [json](https://secure.php.net/manual/en/book.json.php) extensions must be enabled.

## Installation

The recommended way to install is through [Composer](https://getcomposer.org):

```bash
composer require jungle-mob/telegram-bot-api
```

## The simplest example of use

```php
<?php

$tba = new TelegramBotAPI('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11');

$botInfo = $tba->getMe();

echo $botInfo->getFirstName();
```

## License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: [here](https://github.com/jungle-mob/telegram-bot-api/blob/master/license.txt).
