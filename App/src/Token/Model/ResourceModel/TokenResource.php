<?php

declare(strict_types=1);

namespace Wjcrypto\Token\Model\ResourceModel;

use Wjcrypto\Holder\Model\Holder;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Token\Exception\NoSuchEntityException;
use Wjcrypto\Token\Exception\InvalidTokenException;

class TokenResource
{

    private $sql;
    private $holder;

    public function __construct(Sql $sql, Holder $holder)
    {
        $this->sql = $sql;
        $this->holder = $holder;
    }

    public function createToken($holderId)
    {
        $token = uniqid('WJ-');

        $this->sql->query('INSERT INTO token (token, expiration, holder_id) VALUES (:TOKEN, :DT, :HOLDER)', [
            ':TOKEN' => $token,
            ':DT' => date("Y-m-d", strtotime("+5 days")),
            ':HOLDER' => $holderId
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

    public function getHolderByToken(String $token)
    {
        $results = $this->sql->select(
            "SELECT * FROM token as t
                        INNER JOIN holder as h
                            WHERE t.token = :TOKEN AND h.id = t.holder_id",
            [
                ':TOKEN' => $token
            ]
        );

        if (count($results) > 0) {
            $row = $results[0];

            $this->holder->setId($row['id']);
            $this->holder->setName($row['name']);
            $this->holder->setDocument($row['document']);
            $this->holder->setAdditionalDocument($row['additional_document']);
            $this->holder->setDtOrigin(new \DateTime($row['dt_origin']));
            $this->holder->setPhone($row['phone']);
            $this->holder->setAddress($row['address']);
            $this->holder->setUsername($row['username']);
            $this->holder->setPassword($row['password']);
            $this->holder->setAccountNumber($row['account_number']);
            return $this->holder;
        }
        throw new InvalidTokenException('Invalid Token');
    }
}
