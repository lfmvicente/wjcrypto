<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Model;

use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class LoginControllerHandler
{

    private $holderResource;
    private $accountResource;

    public function __construct(HolderResource $holderResource)
    {
        $this->holderResource = $holderResource;
    }

    public function execute(array $params)
    {
        $holder = $this->holderResource->login($params['username'], $params['password']);
        $_SESSION = $holder->getData();
    }
}
