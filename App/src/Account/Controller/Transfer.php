<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Exception\InvalidTransferException;
use Wjcrypto\Account\Model\TransferControllerHandler;
use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;

class Transfer extends AccountSessionControllerValidation
{
    private $transferControllerHandler;

    public function __construct(
        TransferControllerHandler $transferControllerHandler,
        HolderResource $holderResource,
        Logger $logger
    ){
        $this->transferControllerHandler = $transferControllerHandler;
        parent::__construct($holderResource, $logger);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            try {
                $this->transferControllerHandler->execute($_POST, $_SESSION);
            } catch (InvalidTransferException $invalidTransferException) {
                $this->logger->log('Transfer Error: ', $_POST);
                $router::response()->json([
                    "message" => "Transfer Cancelled"
                ]);
            }
            $this->logger->log('Transfer Success: ', $_POST);
            $router::response()->json([
                "Message" => "Transfer Success",
                "Value" => $_POST['amount'],
                "Destination Account" => $_POST['account']
            ]);
        }
    }
}

