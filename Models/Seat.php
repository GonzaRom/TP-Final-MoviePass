<?php
    namespace Models;

    class Seat{
        private $id;
        private $occupied;
        private $movieShow;

        public function __construct(){
            $this->occupied=false;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }
 
        public function getOccupied()
        {
            return $this->occupied;
        }

        public function setOccupied($occupied)
        {
            $this->occupied = $occupied;
            return $this;
        }

        public function setMovieShow($movieShow){
            $this->movieShow = $movieShow;
        }

        public function getMovieShow(){
            return $this->movieShow;
        }
    }
?>