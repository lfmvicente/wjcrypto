<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Model\ResourceModel;

use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Token\Exception\NoSuchEntityException;
use Wjcrypto\Token\Exception\InvalidTokenException;

class TokenResource
{

    private $sql;

    public function __construct(Sql $sql)
    {
        $this->sql = $sql;
    }

    public function createToken()
    {
        $token = uniqid('WJ-');

        $this->sql->query('INSERT INTO token (token, expiration) VALUES (:TOKEN, :DT)', [
            ':TOKEN' => $token,
            ':DT' => date("Y-m-d", strtotime("+5 days"))
        ]);
        return $token;
    }

    public function validateToken(string $token)
    {
        $tokenData = $this->sql->select('SELECT * FROM token WHERE token = :TOKEN', [
            ':TOKEN' => $token
        ]);

        if (count($tokenData) === 0) {
            throw new NoSuchEntityException("Could Not Find Token: $token");
        }

        $actualDate = new \DateTime();
        $tokenDate = new \DateTime($tokenData[0]['expiration']);

        if ($actualDate == $tokenDate || $actualDate > $tokenDate) {
            throw new InvalidTokenException('Your token has been expired');
        }
    }
}
