<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;

class AccountController extends AccountSessionControllerValidation
{
    private $accountResource;

    public function __construct(
        AccountResource $accountResource,
        HolderResource $holderResource,
        Logger $logger
    ){
        $this->accountResource = $accountResource;
        parent::__construct($holderResource, $logger);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            $response = $router::response();
            $response->json([
                'accounts' => $this->accountResource->getAll()
            ]);
        }
    }
}
