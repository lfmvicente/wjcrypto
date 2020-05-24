<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Model;

use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\Encryptor\Model\Encryptor;

class TransferControllerHandler
{
    private $accountResource;
    private $encrypt;

    public function __construct(AccountResource $accountResource, Encryptor $encrypt)
    {
        $this->accountResource = $accountResource;
        $this->encrypt = $encrypt;
    }

    public function execute(array $params, $session)
    {
        $hashAccount = $this->encrypt->encrypt($params['account']);

        if ($hashAccount != $_SESSION['account_number']) {
            $this->accountResource->transfer(
                $params['amount'], 
                $hashAccount,
                $session['account_number']
            );
        }
    }
}
