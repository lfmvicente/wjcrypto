<?php

    declare(strict_types=1);

    namespace Wjcrypto\Validator\Model;

    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;

    define('SECRET_IV', pack('a16', 'wjcrypto'));
    define('SECRET', pack('a16', 'wjcrypto'));

    class Validator
    {
        private $sql;

        public function __construct(Sql $sql)
        {
            $this->sql = $sql;
        }

        public function userValidation($login, $password)
        {
            $pass = openssl_encrypt($password,'AES-128-CBC','SECRET', 0, 'SECRET_IV');
            $results = $this->sql->select(
                "SELECT * FROM holder WHERE username = :USERNAME AND password = :PASSWORD",
                array(
                    ":USERNAME"=>$login,
                    ":PASSWORD"=>$pass
                )
            );
            if (count($results) > 0) {
                return true;
            }
            return false;
        }

        public function tokenValidation($token)
        {
            $results = $this->sql->select(
                "SELECT expiration FROM token WHERE token = :token",
                array(
                    ":token"=>$token
                )
            );
            if (count($results) > 0 && $results[0]['expiration'] >= date ('Y-m-d H:i:s')) {
                return true;
            }
            return false;
        }
    }
