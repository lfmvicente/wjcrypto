<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Model\LoginControllerHandler;
use Wjcrypto\Holder\Exception\InvalidLoginException;
use Wjcrypto\Logger\Model\Logger;

class Login
{

    private $loginControllerHandler;
    private $logger;

    public function __construct(LoginControllerHandler $loginControllerHandler, Logger $logger)
    {
        $this->loginControllerHandler = $loginControllerHandler;
        $this->logger = $logger;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->loginControllerHandler->execute($_POST);
        } catch (InvalidLoginException $invalidLoginException) {
            $this->logger->log('Invalid Login: ' . $invalidLoginException->getMessage());
            $router::response()->redirect('/Html/index.html');
        }
        $router::response()->redirect('/home');
    }
}
