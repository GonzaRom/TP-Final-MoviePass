<?php 

    namespace Models;


    class Room{
        private $id;
        private $name;
        private $capacity;
        private $typeRoom;
        private $idcinema;
        private $active;

        public function __construct(){
            
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }

        public function setTypeRoom($typeRoom){
            $this->typeRoom = $typeRoom;
        }
        
        public function setCinema($idcinema){
            $this->idcinema = $idcinema;
        }

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getCapacity(){
            return $this->capacity;
        }

        public function getTypeRoom(){
            return $this->typeRoom;
        }

        public function getCinema(){
            return $this->idcinema;
        }

        public function setActive($active){
            $this->active = $active;
        }

        public function getActive(){
            return $this->active;
        }
    }
?>