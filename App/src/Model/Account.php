<?php

    namespace Model;

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

        public function getHolder():Holder
        {
            return $this->holder;
        }
    }
