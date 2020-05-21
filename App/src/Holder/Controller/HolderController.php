<?php

namespace Wjcrypto\Holder\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class HolderController
{
    private $holderResource;

    public function __construct(HolderResource $holderResource)
    {
        $this->holderResource = $holderResource;
    }

    public function execute(SimpleRouter $router)
    {
        $response = $router::response();
        $response->json([
           'holders'=>$this->holderResource->getAll()
        ]);
    }
}
