<?php
    namespace Models;

    class CinemaDTO{
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
           
        }

        public function setName($name)
        {
            $this->name = $name;
            
        }

        public function setAdress($adress)
        {
            $this->adress = $adress;
            
        }

        public function setPhonenumber($phonenumber)
        {
            $this->phonenumber = $phonenumber;
            
        }
        
        public function getRooms()
        {
            return $this->rooms;
        }
 
        public function setRooms($rooms)
        {
            $this->rooms = $rooms;

        }
        public function setIsActive($active){
            $this->active = $active;
        }

        public function getIsActive(){
            return $this->active;
        }
    }
?>