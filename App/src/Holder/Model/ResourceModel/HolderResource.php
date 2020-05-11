<?php

    declare(strict_types=1);

    namespace Wjcrypto\Holder\Model\ResourceModel;

    use Wjcrypto\Holder\Exception\InvalidLoginException;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Holder\Model\Holder;

    class HolderResource 
    {

        private $sql;
        private $holder;

        public function __construct(Sql $sql, Holder $holder)
        {
            $this->sql = $sql;
            $this->holder = $holder;
        }

        public function getById($id)
        {
            $results = $this->sql->select("SELECT * FROM holder WHERE id = :ID", array(
                ":ID"=>$id
            ));

            if (count($results) > 0) {
                $row = $results[0];

                $this->holder->setId($row['id']);
                $this->holder->setName($row['name']);
                $this->holder->setDocument($row['document']);
                $this->holder->setAdditionalDocument($row['additional_document']);
                $this->holder->setDtOrigin(new DateTime($row['dt_origin']));
                $this->holder->setPhone($row['phone']);
                $this->holder->setAddress($row['address']);
                $this->holder->setUsername($row['username']);
                $this->holder->setPassword($row['password']);
                $this->holder->setAccount($row['account_number']);
            }
            return $this->holder;
        }

        public function Login($username, $password)
        {
            $results = $this->sql->select(
                "SELECT * FROM holder WHERE username = :USERNAME AND password = :PASSWORD",
                 array(
                    ":USERNAME"=>$username,
                    ":PASSWORD"=>$password
                )
            );

            if (count($results) > 0) {
                $row = $results[0];

                $this->holder->setId($row['id']);
                $this->holder->setName($row['name']);
                $this->holder->setDocument($row['document']);
                $this->holder->setAdditionalDocument($row['additional_document']);
                $this->holder->setDtOrigin(new DateTime($row['dt_origin']));
                $this->holder->setPhone($row['phone']);
                $this->holder->setAddress($row['address']);
                $this->holder->setUsername($row['username']);
                $this->holder->setPassword($row['password']);
                $this->holder->setAccount($row['account_number']);
                return $this->holder;
            }
            
            throw new InvalidLoginException("Login e/ou senha inválidos");
        }
    }
