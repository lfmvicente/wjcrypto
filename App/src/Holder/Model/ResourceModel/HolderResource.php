<?php

    declare(strict_types=1);

    namespace Wjcrypto\Holder\Model\ResourceModel;

use Wjcrypto\Account\Api\AccountSessionControllerValidation;
use Wjcrypto\Account\Model\Account;
    use Wjcrypto\Holder\Exception\HolderNotFoundException;
    use Wjcrypto\Holder\Exception\InvalidLoginException;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Holder\Model\Holder;
    use Wjcrypto\Encryptor\Model\Encryptor;
    use Wjcrypto\Account\Model\ResourceModel\AccountResource;

    class HolderResource
    {
        private $sql;
        private $holder;
        private $encrypt;
        private $account;
        private $accountResource;

        private const QUERY = 'SELECT username, password FROM holder WHERE username = :USERNAME AND password = :PASSWORD';

        public function __construct(
            Sql $sql,
            Holder $holder,
            Encryptor $encrypt,
            Account $account,
            AccountResource $accountResource
        ){
            $this->sql = $sql;
            $this->holder = $holder;
            $this->encrypt = $encrypt;
            $this->account = $account;
            $this->accountResource = $accountResource;
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
                return $this->holder;
            }
            throw new HolderNotFoundException("Usuário não existe");
        }

        public function login($username, $password)
        {
            $results = $this->sql->select(
                "SELECT * FROM holder WHERE username = :USERNAME AND password = :PASSWORD",
                 array(
                    ":USERNAME"=>$this->encrypt->encrypt($username),
                    ":PASSWORD"=>$this->encrypt->encrypt($password)
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
            return $this->holder;
        }

        public function isAuthenticated(string $username, string $password): bool
        {
            $result = $this->sql->select(self::QUERY,[
                ':USERNAME' => $this->encrypt->encrypt($username),
                ':PASSWORD' => $this->encrypt->encrypt($password)
            ]);
            return (count($result) > 0);
        }

        public function getAll()
        {
            $results = $this->sql->select("SELECT * FROM holder");
            return $results;
        }

        public function create(array $params)
        {
            $number  = $this->encrypt->encrypt(uniqid());
            $results = $this->sql->query(
                "INSERT INTO holder 
                (name, document, additional_document, dt_origin, phone, 
                address, username, password, account_number)
                VALUES (:name, :document, :additional_document, :dtorigin, 
                :phone, :address, :username, :password, :account_number)", array(
                "name"=>$this->encrypt->encrypt($params['name']),
                "document"=>$this->encrypt->encrypt($params['document']),
                "additional_document"=>$this->encrypt->encrypt($params['additional_document']),
                "dtorigin"=>$params['dt_origin'],
                "phone"=>$this->encrypt->encrypt($params['phone']),
                "address"=>$this->encrypt->encrypt($params['address']),
                "username"=>$this->encrypt->encrypt($params['username']),
                "password"=>$this->encrypt->encrypt($params['password']),
                "account_number"=>$number
            ));
            $this->account->setNumber($number);
            $this->accountResource->insert($this->account);
        }

        public function getBalance($account)
        {
            $balance = $this->sql->select(
                "SELECT balance, account_number FROM account WHERE account_number = :ACCOUNT",
            [
               "ACCOUNT"=>$account['account_number']
            ]);
            return $balance[0]['balance'];
        }
    }

