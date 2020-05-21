<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Account\Model\WithdrawControllerHandler;

class Withdraw
{
    private $withdrawControllerHandler;

    public function __construct(WithdrawControllerHandler $withdrawControllerHandler)
    {
        $this->withdrawControllerHandler = $withdrawControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->withdrawControllerHandler->execute($_POST, $_SESSION);
        } catch (InvalidAmountException $invalidAmountException) {
            $router::response()->json([
                'message'=>'Saque não efetuado'
            ]);
        }
        $router::response()->json([
            'message'=>'Saque efetuado com sucesso',
            'value'=>$_POST['amount'],
            'account'=>$_SESSION['account_number']
        ]);
    }
}
