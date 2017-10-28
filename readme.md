# Telegram Bot API

[![Travis CI](https://img.shields.io/travis/jungle-bay/telegram-bot-api.svg?style=flat)](https://travis-ci.org/jungle-bay/telegram-bot-api)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/jungle-bay/telegram-bot-api.svg?style=flat)](https://scrutinizer-ci.com/g/jungle-bay/telegram-bot-api)
[![Codecov](https://img.shields.io/codecov/c/github/jungle-bay/telegram-bot-api.svg?style=flat)](https://codecov.io/gh/jungle-bay/telegram-bot-api)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/629ccaba-0a4e-4ea3-b0a4-63d053b5bf30.svg?style=flat)](https://insight.sensiolabs.com/projects/629ccaba-0a4e-4ea3-b0a4-63d053b5bf30)

This is PHP Library for Telegram Bot API.
You can follow [this](https://core.telegram.org/bots/api) documentation to work with the library.

### Prerequisites

   - PHP 5.5 or above.
   - [curl](https://secure.php.net/manual/en/book.curl.php), [json](https://secure.php.net/manual/en/book.json.php) extensions must be enabled.

### Install

The recommended way to install is through [Composer](https://getcomposer.org):

```bash
composer require jungle-bay/telegram-bot-api
```

### The simplest example of use

```php
<?php

use TelegramBotAPI\TelegramBotAPI;

// parameter is your bot token.
$tba = new TelegramBotAPI('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11');

$info = $tba->getMe();

echo $info->getBot();
```

### License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: [here](https://github.com/jungle-bay/telegram-bot-api/blob/master/license.txt).
