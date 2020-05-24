<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Api;

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Exception\NoSuchEntityException;
use Wjcrypto\Logger\Model\Logger;

abstract class TokenAuthenticate
{
    private $tokenResource;
    protected $logger;
    protected $token;

    public function __construct(TokenResource $tokenResource, Logger $logger)
    {
        $this->tokenResource = $tokenResource;
        $this->logger = $logger;
    }

    public function tokenRequestAuthenticate(Request $request)
    {
        $this->token = preg_replace('/(Bearer\s)/','',$request->getHeader('http_authorization'));
        $this->tokenResource->validateToken($this->token);
    }

    public function isValidRequest (SimpleRouter $router): bool
    {
        $response = $router::response();

        try {
            $this->tokenRequestAuthenticate($router::request());
        } catch (InvalidTokenException $invalidTokenException) {
            $this->logger->log('Token Error: ' . $invalidTokenException->getMessage());
            $response->json([
                'message' => $invalidTokenException->getMessage()
            ]);
            return false;
        } catch (NoSuchEntityException $noSuchEntityException) {
            $this->logger->log('Entity Error: ' . $noSuchEntityException->getMessage());
            $response->json([
                'message' => 'Invalid Request'
            ]);
            return false;
        }
        return true;
    }
}
