<?php
    namespace Models;

    class Cinema{
        private $id;
        private $name;
        private $adress;
        private $phonenumber;
        private $isactive;
        
        public function __construct(){

        }

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getAdress()
        {
            return $this->adress;
        }
 
        public function getPhonenumber()
        {
            return $this->phonenumber;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function setAdress($adress)
        {
            $this->adress = $adress;
            return $this;
        }

        public function setPhonenumber($phonenumber)
        {
            $this->phonenumber = $phonenumber;
            return $this;
        }

        public function setIsActive($isactive){
            $this->isactive = $isactive;
        }

        public function getIsActive(){
            return $this->isactive;
        }
    }
?>