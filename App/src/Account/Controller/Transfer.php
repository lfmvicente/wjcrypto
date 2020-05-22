<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Controller;

use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Exception\InvalidTransferException;
use Wjcrypto\Account\Model\TransferControllerHandler;
use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

class Transfer extends AccountSessionControllerValidation
{
    private $transferControllerHandler;

    public function __construct(TransferControllerHandler $transferControllerHandler, HolderResource $holderResource)
    {
        $this->transferControllerHandler = $transferControllerHandler;
        parent::__construct($holderResource);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->validateUserLogin() === true) {
            try {
                $this->transferControllerHandler->execute($_POST, $_SESSION);
            } catch (InvalidTransferException $invalidTransferException) {
                $router::response()->json([
                    "message" => "Valor ou conta Inválidos"
                ]);
            }
            $router::response()->json([
                "Message" => "Transferencia efetuada com sucesso",
                "Value" => $_POST['amount'],
                "Destination Account" => $_POST['account']
            ]);
        }
    }
}

