<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Account\Model\WithdrawControllerHandler;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class Withdraw extends AccountSessionControllerValidation
{
    private $withdrawControllerHandler;

    public function __construct(WithdrawControllerHandler $withdrawControllerHandler, HolderResource $holderResource)
    {
        $this->withdrawControllerHandler = $withdrawControllerHandler;
        parent::__construct($holderResource);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            try {
                $this->withdrawControllerHandler->execute($_POST, $_SESSION);
            } catch (InvalidAmountException $invalidAmountException) {
                $router::response()->json([
                    'message' => 'Saque não efetuado'
                ]);
            }
            $router::response()->json([
                'message' => 'Saque efetuado com sucesso',
                'value' => $_POST['amount'],
                'account' => $_SESSION['account_number']
            ]);
        }
    }
}
