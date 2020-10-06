<?php
    namespace Models;

    class MovieTheater{
        private $id;
        private $name;
        private $adress;
        private $phonenumber;
        
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
    }
?>