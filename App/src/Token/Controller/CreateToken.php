<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Token\Model\CreateTokenRequestHandler;

class CreateToken
{
    private $createTokenRequestHandler;

    public function __construct(CreateTokenRequestHandler $createTokenRequestHandler)
    {
        $this->createTokenRequestHandler = $createTokenRequestHandler;
    }

    public function execute(SimpleRouter $router)
    {
        $request = $router::request();
        $response = $router::response();

        $params = [
            'username'=>$request->getUser(),
            'password'=>$request->getPassword()
        ];

        $token = $this->createTokenRequestHandler->execute($params);

        if ($token === false) {
            $response->header('HTTP/1.0 401 Unauthorized');
            $response->header('WWW-Authenticate: Basic realm="Invalid Login Or Password"');
            $response->json([
                'message' => 'Invalid Login or Password'
            ]);
        } else {
            $response->json([
                'token' => $token
            ]);
        }
    }
}
