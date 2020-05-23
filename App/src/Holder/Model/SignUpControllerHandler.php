<?php

declare(strict_types=1);

namespace Wjcrypto\Holder\Model;

use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Account\Model\ResourceModel\AccountResource;

class SignUpControllerHandler
{
    private $holderResource;

    public function __construct(HolderResource $holderResource)
    {
        $this->holderResource = $holderResource;
    }

    public function execute(array $params)
    {
        $this->holderResource->create($params);
    }
}
