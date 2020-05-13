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
                $this->holder->setDtOrigin(new \DateTime($row['dt_origin']));
                $this->holder->setPhone($row['phone']);
                $this->holder->setAddress($row['address']);
                $this->holder->setUsername($row['username']);
                $this->holder->setPassword($row['password']);
                $this->holder->setAccount($row['account_number']);
            }
            return $this->holder;
        }

        public function login($username, $password)
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
                $this->holder->setDtOrigin(new \DateTime($row['dt_origin']));
                $this->holder->setPhone($row['phone']);
                $this->holder->setAddress($row['address']);
                $this->holder->setUsername($row['username']);
                $this->holder->setPassword($row['password']);
                $this->holder->setAccountNumber($row['account_number']);
                return $this->holder;
            }
            throw new InvalidLoginException("Login e/ou senha inválidos");
        }

        public function insert(Holder $holder)
        {
            $results = $this->sql->query(
                "INSERT INTO holder 
                (name, document, additional_document, dt_origin, phone, 
                address, username, password, account_number)
                VALUES (:name, :document, :additional_document, :dtorigin, 
                :phone, :address, :username, :password, :account_number)", array(
                    "name"=>$holder->getName(),
                    "document"=>$holder->getDocument(),
                    "additional_document"=>$holder->getAdditionalDocument(),
                    "dtorigin"=>$holder->getDtOrigin(),
                    "phone"=>$holder->getDtOrigin(),
                    "address"=>$holder->getAddress(),
                    "username"=>$holder->getUsername(),
                    "password"=>$holder->getPassword(),
                    "account_number"=>"777"
            ));
            return $this;
        }

        public function delete($id)
        {
            $result = $this->sql->query("DELETE FROM holder WHERE id = :ID", array(
                "ID"=>$id
            ));
            return $this;
        }
    }

