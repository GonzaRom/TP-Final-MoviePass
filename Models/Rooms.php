<?php 

    namespace Models;


    class Rooms{
        private $id;
        private $name;
        private $capacity;
        private $typeRoom;
        private $idcinema;

        public function __Construct(){
            
        }

        public function Set_Id($id){
            $this->id = $id;
        }

        public function Set_Name($name){
            $this->name = $name;
        }

        public function Set_Capacity($capacity){
            $this->capacity = $capacity;
        }

        public function Set_TypeRoom($typeRoom){
            $this->typeRoom = $typeRoom;
        }
        
        public function Set_Cinema($idcinema){
            $this->idcinema = $idcinema;
        }

        public function Get_Id(){
            return $this->id;
        }

        public function Get_Name(){
            return $this->name;
        }

        public function Get_Capacity(){
            return $this->capacity;
        }

        public function Get_TypeRoom(){
            return $this->typeRoom;
        }

        public function Get_Cinema(){
            return $this->idcinema;
        }

    }
?>