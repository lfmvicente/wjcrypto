<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Controller;

use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Token\Api\TokenAuthenticate;
use Wjcrypto\Token\Exception\InvalidTokenException;
use Wjcrypto\Token\Exception\NoSuchEntityException;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;

class Testando extends TokenAuthenticate
{

    private $sql;

    public function __construct(TokenResource $tokenResource, Sql $sql)
    {
        $this->sql = $sql;
        parent::__construct($tokenResource);
    }

    public function execute(SimpleRouter $router)
    {
        if ($this->isValidRequest($router) === true) {
            $response = $router::response();

            $response->json([
                'holders' => $this->sql->select('SELECT * FROM holder')
            ]);
        }
    }
}
