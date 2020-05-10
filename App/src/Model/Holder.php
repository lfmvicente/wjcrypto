<?php

    class Holder {

        private $name;
        private $document;
        private $additionalDocument;
        private $dtOrigin;
        private $phone;
        private $address;
        private $username;
        private $password;

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

        public function getAdditionalDocument():string
        {
            return $this->additionalDocument;
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
    }
