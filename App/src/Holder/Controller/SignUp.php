<?php

declare(strict_types=1);

namespace Wjcrypto\Holder\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Holder\Exception\InvalidDataException;
use Wjcrypto\Holder\Model\SignUpControllerHandler;
use Wjcrypto\Logger\Model\Logger;

class SignUp
{
    private $signUpControllerHandler;
    private $logger;

    public function __construct(SignUpControllerHandler $signUpControllerHandler, Logger $logger)
    {
        $this->signUpControllerHandler = $signUpControllerHandler;
        $this->logger = $logger;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->signUpControllerHandler->execute($_POST);
        } catch (InvalidDataException $invalidDataException) {
            $this->logger->log('SignUp Error: ' . $invalidDataException->getMessage());
            $router::response()->json([
                'message' => 'Dados inválidos, preencha novamente'
            ]);
        }
        $this->logger->log('SignUp Success: ', $_POST);
        $router::response()->json([
            'message' => 'Cadastro concluído com sucesso'
        ]);
    }
}
