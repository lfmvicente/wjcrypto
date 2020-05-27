<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Logger\Model\Logger;
use Wjcrypto\Token\Api\TokenAuthenticate;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\WebApi\Model\RestfullWithdrawControllerHandler;

class RestfullWithdraw extends TokenAuthenticate
{
    private $restfullWithdrawControllerHandler;

    public function __construct(
        TokenResource $tokenResource,
        Logger $logger,
        RestfullWithdrawControllerHandler $restfullWithdrawControllerHandler
    ){
        parent::__construct($tokenResource, $logger);
        $this->restfullWithdrawControllerHandler = $restfullWithdrawControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->isValidRequest($router) == true) {
            try{
                $this->restfullWithdrawControllerHandler->execute($_POST, $this->token);
                $this->logger->log('Withdraw Success: ', $_POST);
                $router::response()->json([
                    'msg'=>'Withdraw Success'
                ]);
            } catch (InvalidAmountException $invalidAmountException) {
                $this->logger->log($invalidAmountException->getMessage());
                $router::response()->json([
                    'msg'=>$invalidAmountException->getMessage()
                ]);
            }
        }
    }
}
