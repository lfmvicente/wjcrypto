<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Model\ResourceModel\AccountResource;

class AccountController
{
    private $accountResource;

    public function __construct(AccountResource $accountResource)
    {
        $this->accountResource = $accountResource;
    }

    public function execute(SimpleRouter $router)
    {
        $response = $router::response();
        $response->json([
           'accounts'=>$this->accountResource->getAll()
        ]);
    }
}
