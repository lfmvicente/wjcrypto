<?php

namespace Wjcrypto\Holder\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class HolderController extends AccountSessionControllerValidation
{
    private $holderResource;

    public function __construct(HolderResource $holderResource, HolderResource $holderParent)
    {
        $this->holderResource = $holderResource;
        parent::__construct($holderParent);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            $response = $router::response();
            $response->json([
                'holders' => $this->holderResource->getAll()
            ]);
        }
    }
}
