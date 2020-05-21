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

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getId(),
                "token"=>$this->getToken(),
                "expiration"=>$this->getExpiration()
            ));
        }
    }
