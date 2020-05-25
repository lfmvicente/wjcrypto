<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;
use Wjcrypto\Token\Api\TokenAuthenticate;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;

class RestfullHolder extends TokenAuthenticate
{
    private $holderResource;

    public function __construct(
        TokenResource $tokenResource,
        Logger $logger,
        HolderResource $holderResource
    ){
        parent::__construct($tokenResource, $logger);
        $this->holderResource = $holderResource;
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->isValidRequest($router) == true) {
            try{
                $router::response()->json([
                    'holders'=>$this->holderResource->getAll()
                ]);
            } catch (InvalidTokenException $invalidTokenException) {
                $this->logger->log($invalidTokenException->getMessage());
                $router::response()->json([
                    'msg'=>$invalidTokenException->getMessage()
                ]);
            }
        }
    }
}
