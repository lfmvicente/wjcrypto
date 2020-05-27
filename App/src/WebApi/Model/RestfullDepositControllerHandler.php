<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Model;

use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Account\Model\ResourceModel\AccountResource;

class RestfullDepositControllerHandler
{
    private $tokenResource;
    private $accountResource;

    public function __construct(AccountResource $accountResource, TokenResource $tokenResource)
    {
        $this->accountResource = $accountResource;
        $this->tokenResource = $tokenResource;
    }

    public function execute(array $params, string $token = '')
    {
        $holder = $this->tokenResource->getHolderByToken($token);
        $this->accountResource->deposit($params['amount'], $holder->getAccountNumber());
    }
}
