<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;

class Logout
{
    public function execute(SimpleRouter $router)
    {
        $_SESSION = array();
        $router::response()->redirect('/Html/index.html');
    }
}
