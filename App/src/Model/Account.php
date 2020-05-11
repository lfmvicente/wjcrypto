<?php

    //namespace wjcrypto\Model;

    require "../config.php";

    class Account
    {

        private $id;
        private $number;
        private $balance;
        private $holder;

        public function __construct()
        {
            $this->balance = 0;
        }
        
        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getNumber()
        {
            return $this->number;
        }

        public function setNumber($number)
        {
            $this->number = $number;
        }

        public function getBalance()
        {
            return $this->balance;
        }

        public function setBalance($balance)
        {
            $this->balance = $balance;
        }

        public function getHolderId()
        {
            return $this->holder->getIdHolder();
        }

        public function setHolderId($holder)
        {
            $this->holder->id = $holder;
        }
        

        public function deposit($amount)
        {
            if ($amount > 0) {
               return $this->balance += $amount;
            }
            return "Quantia Inválida";
        }

        public function withdraw($amount)
        {
            if ($amount < $this->balance) {
                return $this->balance -= $amount;
            }
            return "Sem Saldo";
        }

        public function transfer($amount, $account)
        {
            if ($amount > 0) {
                $this->balance -= $amount;
                $account->deposit($amount);
                return $this;
            }
            return "Valor inválido";
        }

        public function loadById($id)
        {
            $sql = new Sql();

            $results = $sql->select("SELECT * FROM account WHERE id = :ID", array(
                ":ID"=>$id
            ));

            if (count($results) > 0) {
                $row = $results[0];

                $this->setId($row['id']);
                $this->setNumber($row['account_number']);
                $this->setBalance($row['balance']);
                $this->setHolderId($row['id_holder']);
            }
        }

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getId(),
                "number"=>$this->getNumber(),
                "balance"=>$this->getBalance(),
                "id_holder"=>$this->holder->id
            ));
        }
    }
