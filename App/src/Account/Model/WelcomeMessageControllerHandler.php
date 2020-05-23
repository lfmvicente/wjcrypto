<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Model;

use Wjcrypto\Account\Model\ResourceModel\AccountResource;

class WelcomeMessageControllerHandler
{
    private $accountResource;

    public function __construct(AccountResource $accountResource)
    {
        $this->accountResource = $accountResource;
    }

    public function execute()
    {
        return 'Olá ' . $_SESSION['name'] . ', seu saldo é de R$ ' . $_SESSION['balance'];
    }
}
