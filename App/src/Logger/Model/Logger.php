<?php

declare(strict_types=1);

namespace Wjcrypto\Logger\Model;

use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;

class Logger
{

    public function log($message, array $context = [])
    {
        $logger = new Monolog('wjcrypto');
        $logger->pushHandler(new StreamHandler(__DIR__.'/../../../../var/log/debug.log', Monolog::DEBUG));
        $logger->info($message, $context);
    }
}
