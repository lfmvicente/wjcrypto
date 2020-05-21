<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Account\Model\DepositControllerHandler;

class Deposit
{
    private $depositControllerHandler;

    public function __construct(DepositControllerHandler $depositControllerHandler)
    {
        $this->depositControllerHandler = $depositControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->depositControllerHandler->execute($_POST, $_SESSION);
        } catch (InvalidAmountException $invalidAmountException) {
            $router::response()->json([
                'message'=>'Depósito não efetuado'
            ]);
        }
        $router::response()->json([
            'message'=>'Depósito efetuado com sucesso',
            'value'=>$_POST['amount'],
            'account'=>$_SESSION['account_number']
        ]);
    }
}
