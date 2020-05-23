<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Api;

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Exception\NoSuchEntityException;

abstract class TokenAuthenticate
{
    private $tokenResource;

    public function __construct(TokenResource $tokenResource)
    {
        $this->tokenResource = $tokenResource;
    }

    public function tokenRequestAuthenticate(Request $request)
    {
        $token = preg_replace('/(Bearer\s)/','',$request->getHeader('http_authorization'));
        $this->tokenResource->validateToken($token);
    }

    public function isValidRequest (SimpleRouter $router): bool
    {
        $response = $router::response();

        try {
            $this->tokenRequestAuthenticate($router::request());
        } catch (InvalidTokenException $invalidTokenException) {
            $response->json([
                'message' => $invalidTokenException->getMessage()
            ]);
            return false;
        } catch (NoSuchEntityException $noSuchEntityException) {
            $response->json([
                'message' => 'Invalid Request'
            ]);
            return false;
        }
        return true;
    }
}
