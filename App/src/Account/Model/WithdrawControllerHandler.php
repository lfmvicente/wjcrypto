<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Model;

use Wjcrypto\Account\Model\ResourceModel\AccountResource;

class WithdrawControllerHandler
{
    private $accountResource;

    public function __construct(AccountResource $accountResource)
    {
        $this->accountResource = $accountResource;
    }

    public function execute(array $params, $session)
    {
        return $account = $this->accountResource->withdraw($params['amount'], $session['account_number']);
    }
}
