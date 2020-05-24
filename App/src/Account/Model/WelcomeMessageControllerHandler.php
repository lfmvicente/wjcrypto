<?php

declare(strict_types=1);

namespace Wjcrypto\Account\Model;

use Wjcrypto\Encryptor\Model\Encryptor;

class WelcomeMessageControllerHandler
{

    private $encrypt;

    public function __construct(Encryptor $encrypt)
    {
        $this->encrypt = $encrypt;
    }
    
    public function execute()
    {
        return 
            'Olá ' .
            $this->encrypt->decrypt($_SESSION['name']) .
            ', seu saldo é de R$ ' . $_SESSION['balance'] .
            '. Numero da Conta: ' .
            $this->encrypt->decrypt($_SESSION['account_number']);
    }
}
