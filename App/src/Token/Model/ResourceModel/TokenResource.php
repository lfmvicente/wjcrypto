<?php

    declare(strict_types=1);

    namespace Wjcrypto\Token\Model\ResourceModel;

    use Wjcrypto\Token\Model\Token;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;

    class TokenResource
    {
        private $token;
        private $sql;

        public function __construct(Sql $sql, Token $token)
        {
            $this->sql = $sql;
            $this->token = $token;
        }

        public function save(Token $token)
        {
            $today = date( 'd-m-Y H:i:s');
            $expiration = new \DateTime($today);
            $expiration->add(new \DateInterval('PT04H'));

            $results = $this->sql->query(
                "INSERT INTO token (token, expiration) VALUES (:token, :expiration)", array(
                    "token"=>$token->getToken(),
                    "expiration"=>$expiration->format('Y-m-d H:i:s')
            ));
            return $this;
        }
    }

