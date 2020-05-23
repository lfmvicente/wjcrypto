<?php

    declare(strict_types=1);

    namespace Wjcrypto\Holder\Model;

    use Wjcrypto\Account\Model\Account;
    use Wjcrypto\Holder\Exception\InvalidLoginException;

    class Holder
    {

        private $id;
        private $name;
        private $document;
        private $additionalDocument;
        private $dtOrigin;
        private $phone;
        private $address;
        private $username;
        private $password;
        private $account;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getDocument()
        {
            return $this->document;
        }

        public function setDocument($document)
        {
            $this->document = $document;
        }

        public function getAdditionalDocument()
        {
            return $this->additionalDocument;
        }

        public function setAdditionalDocument($additionalDocument)
        {
            $this->additionalDocument = $additionalDocument;
        }

        public function getDtOrigin()
        {
            return $this->dtOrigin;
        }

        public function setDtOrigin($dtOrigin)
        {
            $this->dtOrigin = $dtOrigin;
        }

        public function getPhone()
        {
            return $this->phone;
        }

        public function setPhone($phone)
        {
            $this->phone = $phone;
        }

        public function getAddress()
        {
            return $this->address;
        }

        public function setAddress($address)
        {
            $this->address = $address;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function setUsername($username)
        {
            $this->username = $username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = openssl_encrypt($password,'AES-128-CBC','SECRET',
                0, 'SECRET_IV');
        }

        public function getAccountNumber()
        {
            return $this->account;
        }

        public function setAccountNumber($account)
        {
            $this->account = $account;
        }

        public function getData()
        {
            return [
                "id"=>$this->getId(),
                "name"=>$this->getName(),
                "document"=>$this->getDocument(),
                "additional_document"=>$this->getAdditionalDocument(),
                "dt_origin"=>$this->getDtOrigin(),
                "phone"=>$this->getPhone(),
                "address"=>$this->getAddress(),
                "username"=>$this->getUsername(),
                "password"=>$this->getPassword(),
                "account_number"=>$this->getAccountNumber()
            ];
        }

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getId(),
                "name"=>$this->getName(),
                "document"=>$this->getDocument(),
                "additional_document"=>$this->getAdditionalDocument(),
                "dt_origin"=>$this->getDtOrigin(),
                "phone"=>$this->getPhone(),
                "address"=>$this->getAddress(),
                "username"=>$this->getUsername(),
                "password"=>$this->getPassword(),
                "account_number"=>$this->getAccountNumber()
            ));
        }
    }

