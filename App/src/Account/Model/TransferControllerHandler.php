<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Model;

use Wjcrypto\Account\Model\ResourceModel\AccountResource;

class TransferControllerHandler
{
    private $accountResource;

    public function __construct(AccountResource $accountResource)
    {
        $this->accountResource = $accountResource;
    }

    public function execute(array $params, $session)
    {
        return $this->accountResource->transfer($params['amount'], $params['account'], $session['account_number']);
    }
}
