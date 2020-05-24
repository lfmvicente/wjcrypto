<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Logger\Model\Logger;
use Wjcrypto\Token\Api\TokenAuthenticate;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\WebApi\Model\RestfullDepositControllerHandler;

class RestfullDeposit extends TokenAuthenticate
{
    private $restfullDepositControllerHandler;

    public function __construct(
        TokenResource $tokenResource,
        Logger $logger,
        RestfullDepositControllerHandler $restfullDepositControllerHandler
    ){
        parent::__construct($tokenResource, $logger);
        $this->restfullDepositControllerHandler = $restfullDepositControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->isValidRequest($router) == true) {
            try{
                $this->restfullDepositControllerHandler->execute($_POST, $this->token);
                $router::response()->json([
                    'msg'=>'Success Deposit'
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
