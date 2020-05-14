<?php

    declare(strict_types=1);

    namespace Wjcrypto\Holder\Model\ResourceModel;

    use Wjcrypto\Account\Model\Account;
    use Wjcrypto\Holder\Exception\InvalidLoginException;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Holder\Model\Holder;

    define('SECRET_IV', pack('a16', 'wjcrypto'));
    define('SECRET', pack('a16', 'wjcrypto'));

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
                $this->holder->setAccountNumber($row['account_number']);
            }
            return $this->holder;
        }

        public function login($username, $password)
        {
            $crypt = openssl_encrypt($password,'AES-128-CBC','SECRET', 0, 'SECRET_IV');
            $results = $this->sql->select(
                "SELECT * FROM holder WHERE username = :USERNAME AND password = :PASSWORD",
                 array(
                    ":USERNAME"=>$username,
                    ":PASSWORD"=>$crypt
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
                    "phone"=>$holder->getPhone(),
                    "address"=>$holder->getAddress(),
                    "username"=>$holder->getUsername(),
                    "password"=>$holder->getPassword(),
                    "account_number"=>$holder->getAccountNumber()
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

        public function update(Holder $holder)
        {
            $results = $this->sql->query(
                "UPDATE holder SET
                    name = :name,
                    document = :document,
                    additional_document = :additional_document,
                    dt_origin = :dtorigin,
                    phone = :phone,
                    address = :address,
                    username = :username,
                    password = :password
                    WHERE id = :ID", array(
                "ID"=>$holder->getId(),
                "name"=>$holder->getName(),
                "document"=>$holder->getDocument(),
                "additional_document"=>$holder->getAdditionalDocument(),
                "dtorigin"=>$holder->getDtOrigin(),
                "phone"=>$holder->getPhone(),
                "address"=>$holder->getAddress(),
                "username"=>$holder->getUsername(),
                "password"=>$holder->getPassword()
            ));
            return $this;
        }

        public function createAccount(Account $account)
        {

        }
    }

