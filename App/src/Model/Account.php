<?php

    //namespace wjcrypto\Model;

    require "../config.php";

    class Account
    {

        private $idAccount;
        private $number;
        private $balance;
        private $holder;

        public function __construct()
        {
            $this->balance = 0;
        }
        
        public function getIdAccount():int
        {
            return $this->idAccount;
        }

        public function setIdAccount(int $idAccount)
        {
            $this->idAccount = $idAccount;
        }

        public function getNumber():string
        {
            return $this->number;
        }

        public function setNumber($number)
        {
            $this->number = $number;
        }

        public function getBalance():float
        {
            return $this->balance;
        }

        public function setBalance($balance)
        {
            $this->balance = $balance;
        }

        public function getHolder():Holder
        {
            return $this->holder->getName();
        }

        public function setHolder($holder)
        {
            $this->holder = $holder;
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

        public function loadById($idAccount)
        {
            $sql = new Sql();

            $results = $sql->select("SELECT * FROM account WHERE id = :ID", array(
                ":ID"=>$idAccount
            ));

            if (count($results) > 0) {
                $row = $results[0];

                $this->setIdAccount($row['id']);
                $this->setNumber($row['account_number']);
                $this->setBalance($row['balance']);
                $this->setHolder($row['id_holder']);
            }
        }

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getIdAccount(),
                "number"=>$this->getNumber(),
                "balance"=>$this->getBalance()
            ));
        }
    }
