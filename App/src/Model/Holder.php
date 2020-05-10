<?php

    //namespace wjcrypto\Model;
    //require "Sql.php";
    require "../config.php";

    class Holder {

        private $idHolder;
        private $name;
        private $document;
        private $additionalDocument;
        private $dtOrigin;
        private $phone;
        private $address;
        private $username;
        private $password;
        private $account;

        public function getIdHolder():int
        {
            return $this->idHolder;
        }

        public function setIdHolder(int $idHolder)
        {
            $this->idHolder = $idHolder;
        }

        public function getName():string
        {
            return $this->name;
        }

        public function setName(string $name)
        {
            $this->name = $name;
        }

        public function getDocument():string
        {
            return $this->document;
        }

        public function setDocument($document)
        {
            $this->document = $document;
        }

        public function getAdditionalDocument():string
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

        public function getPhone():string
        {
            return $this->phone;
        }

        public function setPhone($phone)
        {
            $this->phone = $phone;
        }

        public function getAddress():string
        {
            return $this->address;
        }

        public function setAddress($address)
        {
            $this->address = $address;
        }

        public function getUsername():string
        {
            return $this->username;
        }

        public function setUsername($username)
        {
            $this->username = $username;
        }

        public function getPassword():string
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getAccount():Account
        {
            return $this->account->getNumber();
        }

        public function setAccount($account)
        {
            $this->account = $account;
        }

        public function loadById($idHolder)
        {
            $sql = new Sql();

            $results = $sql->select("SELECT * FROM holder WHERE id = :ID", array(
                ":ID"=>$idHolder
            ));

            if (count($results) > 0) {
                $row = $results[0];

                $this->setIdHolder($row['id']);
                $this->setName($row['name']);
                $this->setDocument($row['document']);
                $this->setAdditionalDocument($row['additional_document']);
                $this->setDtOrigin($row['dt_origin']);
                $this->setPhone($row['phone']);
                $this->setAddress($row['address']);
                $this->setUsername($row['username']);
                $this->setAccount($row['account']);
            }
        }

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getIdHolder(),
                "name"=>$this->getName(),
                "document"=>$this->getDocument()
            ));
        }
    }
