# Logging-http-logger

[![Travis CI](https://api.travis-ci.org/qlimix/logging-http-logger.svg?branch=master)](https://travis-ci.org/qlimix/logging-http-logger)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/logging-http-logger.svg)](https://coveralls.io/github/qlimix/logging-http-logger)
[![Packagist](https://img.shields.io/packagist/v/qlimix/logging-http-logger.svg)](https://packagist.org/packages/qlimix/logging-http-logger)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/logging-http-logger/blob/master/LICENSE)

Logging PSR-7 http requests.

## Install

Using Composer:

~~~
$ composer require qlimix/logging-http-logger
~~~

## usage
Logging requests:
```php
<?php

use Qlimix\Log\Logger\Request\PSRRequestLogger;

$logHandler = new FooBarLogHandler();

$requestLogger = new PSRRequestLogger($logHandler);

$requestLogger->log(new Request());
```
Logging responses:
```php
<?php

use Qlimix\Log\Logger\Response\PSRResponseLogger;

$logHandler = new FooBarLogHandler();

$responseLogger = new PSRResponseLogger($logHandler);

$responseLogger->log(new Request());
```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
