<?php
    namespace Models;

    class Cinema{
        private $id;
        private $name;
        private $adress;
        private $phonenumber;
        private $rooms;
        
        public function __Construct(){

        }

        public function GetId()
        {
            return $this->id;
        }

        public function GetName()
        {
            return $this->name;
        }

        public function GetAdress()
        {
            return $this->adress;
        }
 
        public function GetPhonenumber()
        {
            return $this->phonenumber;
        }

        public function SetId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function SetName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function SetAdress($adress)
        {
            $this->adress = $adress;
            return $this;
        }

        public function SetPhonenumber($phonenumber)
        {
            $this->phonenumber = $phonenumber;
            return $this;
        }

        
        public function GetRooms()
        {
            return $this->rooms;
        }
 
        public function SetRooms($rooms)
        {
            $this->rooms = $rooms;
            return $this;
        }
    }
?>