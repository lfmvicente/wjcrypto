<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Exception\InvalidAmountException;
use Wjcrypto\Account\Model\DepositControllerHandler;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class Deposit extends AccountSessionControllerValidation
{
    private $depositControllerHandler;

    public function __construct(DepositControllerHandler $depositControllerHandler, HolderResource $holderResource)
    {
        $this->depositControllerHandler = $depositControllerHandler;
        parent::__construct($holderResource);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            try {
                $this->depositControllerHandler->execute($_POST, $_SESSION);
            } catch (InvalidAmountException $invalidAmountException) {
                $router::response()->json([
                    'message' => 'Depósito não efetuado'
                ]);
            }
            $router::response()->json([
                'message' => 'Depósito efetuado com sucesso',
                'value' => $_POST['amount'],
                'account' => $_SESSION['account_number']
            ]);
        }
        $router::response()->redirect('/Html/index.html');
    }
}
