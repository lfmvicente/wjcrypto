<?php

    declare(strict_types=1);

    namespace Wjcrypto\Account\Model;

    use Wjcrypto\Holder\Model\Holder;

    class Account
    {

        private $id;
        private $number;
        private $balance;
        private $holder;

        public function __construct($holder)
        {
            $this->balance = 0;
            $this->number = 1000;
            $this->holder = $holder;
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

        public function generateNumber($holder)
        {
            $this->number += $holder->getId();
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
            return $this->holder->getId();
        }

        public function setHolderId(Holder $holder)
        {
            $this->holder = $holder->getId();
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

        public function __toString()
        {
            return json_encode(array(
                "id"=>$this->getId(),
                "number"=>$this->getNumber(),
                "balance"=>$this->getBalance(),
                "id_holder"=>$this->getHolderId()
            ));
        }
    }

