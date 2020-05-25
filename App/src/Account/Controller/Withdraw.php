<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Account\Model\WithdrawControllerHandler;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;

class Withdraw extends AccountSessionControllerValidation
{
    private $withdrawControllerHandler;

    public function __construct(
        WithdrawControllerHandler $withdrawControllerHandler,
        HolderResource $holderResource,
        Logger $logger
    ){
        $this->withdrawControllerHandler = $withdrawControllerHandler;
        $this->logger = $logger;
        parent::__construct($holderResource, $logger);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            try {
                $this->withdrawControllerHandler->execute($_POST, $_SESSION);
            } catch (InvalidAmountException $invalidAmountException) {
                $this->logger->log('Withdraw Error: ', $_POST);
                $router::response()->json([
                    'message' => 'Withdraw Cancelled'
                ]);
            }
            $this->logger->log('Withdraw Success: ', $_POST);
            $router::response()->json([
                'message' => 'Withdraw Success',
                'value' => $_POST['amount'],
                'account' => $_SESSION['account_number']
            ]);
        }
    }
}
