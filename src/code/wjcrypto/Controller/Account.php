<?php

    class Account
    {

        private $number;
        private $balance;
        private $holder;

        public function __construct()
        {
            $this->balance = 0;
        }
        
        public function getNumber():string
        {
            return $this->number;
        }

        public function getBalance():float
        {
            return $this->balance;
        }

        public function deposit($amount)
        {
            if ($amount > 0) {
               return $this->balance += $amount;
            }
            throw new Exception("Quantia Inválida");
        }

        public function withdraw($amount)
        {
            if ($amount < $this->balance) {
                return $this->balance -= $amount;
            }
            throw new Exception("Sem Saldo");
        }

        public function transfer($amount, $account)
        {
            if ($amount > 0) {
                $this->balance -= $amount;
                $account->deposit($amount);
                return $this;
            }
            throw new Exception("Valor inválido");
        }
    }
