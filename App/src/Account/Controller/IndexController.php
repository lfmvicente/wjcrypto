<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;

class IndexController
{
    public function execute(SimpleRouter $router)
    {
        $router::response()->redirect('/Html/index.html');
    }
}
