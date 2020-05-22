<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Wjcrypto\Account\Exception\InvalidTransferException;
use Wjcrypto\Account\Model\TransferControllerHandler;
use Pecee\SimpleRouter\SimpleRouter;

class Transfer
{
    private $transferControllerHandler;

    public function __construct(TransferControllerHandler $transferControllerHandler)
    {
        $this->transferControllerHandler = $transferControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->transferControllerHandler->execute($_POST, $_SESSION);
        } catch (InvalidTransferException $invalidTransferException) {
            $router::response()->json([
                "message"=>"Invalid value or account"
            ]);
        }
        $router::response()->json([
            "Message"=>"Transferencia efetuada com sucesso",
            "Value"=>$_POST['amount'],
            "Destination Account"=>$_POST['account']
        ]);
    }
}
