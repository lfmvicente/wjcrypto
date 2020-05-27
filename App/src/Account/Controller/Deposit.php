<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Account\Model\DepositControllerHandler;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Logger\Model\Logger;

class Deposit extends AccountSessionControllerValidation
{
    private $depositControllerHandler;

    public function __construct(
        DepositControllerHandler $depositControllerHandler, 
        HolderResource $holderResource,
        Logger $logger
    ){
        $this->depositControllerHandler = $depositControllerHandler;
        parent::__construct($holderResource, $logger);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            try {
                $this->depositControllerHandler->execute($_POST, $_SESSION);
            } catch (InvalidAmountException $invalidAmountException) {
                $this->logger->log('Deposit Error: ' . $invalidAmountException->getMessage());
                $router::response()->json([
                    'message' => 'Deposit Cancelled'
                ]);
            }
            $this->logger->log('Deposit Success: ', $_POST);
            $router::response()->json([
                'message' => 'Deposit Success',
                'value' => $_POST['amount'],
                'account' => $_SESSION['account_number']
            ]);
        }
        $router::response()->redirect('/Html/index.html');
    }
}
