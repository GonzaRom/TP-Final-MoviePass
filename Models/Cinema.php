<?php
    namespace Models;

    class Cinema{
        private $id;
        private $name;
        private $adress;
        private $phonenumber;
        private $rooms;
        private $active;
        
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

        
        public function getRooms()
        {
            return $this->rooms;
        }
 
        public function setRooms($rooms)
        {
            $this->rooms = $rooms;
            return $this;
        }
        public function setActive($active){
            $this->active = $active;
        }

        public function getActive(){
            return $this->active;
        }
    }
?>