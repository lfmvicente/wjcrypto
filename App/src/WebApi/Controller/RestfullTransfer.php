<?php

declare(strict_types=1);

namespace Wjcrypto\WebApi\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Logger\Model\Logger;
use Wjcrypto\Token\Api\TokenAuthenticate;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\WebApi\Model\RestfullTransferControllerHandler;

class RestfullTransfer extends TokenAuthenticate
{
    private $restfullTransferControllerHandler;

    public function __construct(
        TokenResource $tokenResource,
        Logger $logger,
        RestfullTransferControllerHandler $restfullTransferControllerHandler
    ){
        parent::__construct($tokenResource, $logger);
        $this->restfullTransferControllerHandler = $restfullTransferControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->isValidRequest($router) == true) {
            try{
                $this->restfullTransferControllerHandler->execute($_POST, $this->token);
                $this->logger->log('Transfer Success: ', $_POST);
                $router::response()->json([
                    'msg'=>'Transfer Success'
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
