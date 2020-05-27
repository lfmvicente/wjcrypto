<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Model;

use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\Encryptor\Model\Encryptor;

class RestfullTransferControllerHandler
{
    private $tokenResource;
    private $accountResource;
    private $encrypt;

    public function __construct(AccountResource $accountResource, TokenResource $tokenResource, Encryptor $encrypt)
    {
        $this->accountResource = $accountResource;
        $this->tokenResource = $tokenResource;
        $this->encrypt = $encrypt;
    }

    public function execute(array $params, string $token = '')
    {
        $hashAccount = $this->encrypt->encrypt($params['account']);
        $holder = $this->tokenResource->getHolderByToken($token);
        $this->accountResource->transfer($params['amount'], $hashAccount, $holder->getAccountNumber());
    }
}
