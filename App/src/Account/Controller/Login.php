<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Model\LoginControllerHandler;
use Wjcrypto\Holder\Exception\InvalidLoginException;

class Login
{
    private $loginControllerHandler;

    public function __construct(LoginControllerHandler $loginControllerHandler)
    {
        $this->loginControllerHandler = $loginControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->loginControllerHandler->execute($_POST);
        } catch (InvalidLoginException $invalidLoginException) {
            $router::response()->redirect('/Html/index.html');
        }$router::response()->redirect('/home');
    }
}
