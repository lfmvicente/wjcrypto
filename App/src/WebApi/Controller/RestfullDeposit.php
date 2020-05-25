<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Exception\InvalidAmountException;
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
            } catch (InvalidAmountException $invalidAmountException) {
                $this->logger->log($invalidAmountException->getMessage());
                $router::response()->json([
                    'msg'=>$invalidAmountException->getMessage()
                ]);
            }
            $this->logger->log('Deposit Success: ', $_POST);
            $router::response()->json([
                'msg'=>'Deposit Success'
            ]);
        }
    }
}
