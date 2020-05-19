<?php

    declare(strict_types=1);

    namespace Wjcrypto\Token\Model;

    use Wjcrypto\Token\Exception\UserNotAuthorizedException;

    class Token
    {
        private $id;
        private $token;
        private $expiration;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getToken()
        {
            return $this->token;
        }

        public function setToken($token)
        {
            $this->token = $token;
        }

        public function getExpiration()
        {
            return $this->expiration;
        }

        public function setExpiration($expiration)
        {
            $this->expiration = $expiration;
        }

        public function generateToken($result)
        {
            if ($result == true) {
                $bytes = random_bytes(64);
                $token = hash('sha256', $bytes);
                $this->setToken($token);
                return $this;
            }
            throw new UserNotAuthorizedException("Usuário não autorizado");
        }

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getId(),
                "token"=>$this->getToken(),
                "expiration"=>$this->getExpiration()
            ));
        }
    }
