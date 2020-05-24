<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;

class Home extends AccountSessionControllerValidation
{
    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            $this->logger->log('Home Access: ', $_SESSION);
            $router::response()->redirect('/Html/home.html');
        }
        $this->logger->log('Invalid Access: ', $_SESSION);
        $router::response()->redirect('/Html/index.html');
    }
}
