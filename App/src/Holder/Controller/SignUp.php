<?php

declare(strict_types=1);

namespace Wjcrypto\Holder\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Holder\Exception\InvalidDataException;
use Wjcrypto\Holder\Model\SignUpControllerHandler;

class SignUp
{
    private $signUpControllerHandler;

    public function __construct(SignUpControllerHandler $signUpControllerHandler)
    {
        $this->signUpControllerHandler = $signUpControllerHandler;
    }

    public function execute(SimpleRouter $router)
    {
        try {
            $this->signUpControllerHandler->execute($_POST);
        } catch (InvalidDataException $invalidDataException) {
            $router::response()->json([
                'message' => 'Dados inválidos, preencha novamente'
            ]);
        }
        $router::response()->json([
            'message' => 'Cadastro concluído com sucesso'
        ]);
        $router::response()->redirect('/Html/index.html');
    }
}
