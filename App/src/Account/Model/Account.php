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
            return $this->holder;
        }

        public function setHolderId($holder)
        {
            $this->holder = $holder;
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
