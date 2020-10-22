<?php
    namespace Models;

    class CreditCard{
        private $creditnumber;
        private $name;
        private $expiration;
        private $code;

        public function __construct(){

        }

        public function getCreditnumber()
        {
            return $this->creditnumber;
        }

        public function setCreditnumber($creditnumber)
        {
            $this->creditnumber = $creditnumber;
            return $this;
        }
 
        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function getExpiration()
        {
            return $this->expiration;
        }

        public function setExpiration($expiration)
        {
            $this->expiration = $expiration;
            return $this;
        }

        public function getCode()
        {
            return $this->code;
        }

        public function setCode($code)
        {
            $this->code = $code;
            return $this;
        }
    }
?>