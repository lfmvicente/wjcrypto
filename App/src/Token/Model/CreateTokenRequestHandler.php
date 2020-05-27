<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Model;

use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class CreateTokenRequestHandler
{

    private $holderResource;

    private $tokenResource;

    public function __construct(HolderResource $holderResource, TokenResource $tokenResource)
    {
        $this->holderResource = $holderResource;
        $this->tokenResource = $tokenResource;
    }

    public function execute(array $params)
    {
        $isAuthenticate = $this->holderResource->isAuthenticated($params['username'], $params['password']);

        if ($isAuthenticate === true) {
            $holder = $this->holderResource->login($params['username'], $params['password']);
            return $this->tokenResource->createToken($holder->getId());
        }
        return false;
    }
}
