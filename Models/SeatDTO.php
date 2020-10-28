<?php
    namespace Models;

    class SeatDTO{
        private $id;
        private $numAsiento;
        private $occupied;
        private $movieShow;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->Id = $id;
        }

        public function getNumSeat()
        {
            return $this->numAsiento;
        }

        public function setNumSeat($numAsiento)
        {
            $this->numAsiento = $numAsiento;
        }
 
        public function getOccupied()
        {
            return $this->occupied;
        }

        public function setOccupied($occupied)
        {
            $this->occupied = $occupied;
            
        }

        public function setMovieShow($movieShow){
            $this->movieShow = $movieShow;
        }

        public function getMovieShow(){
            return $this->movieShow;
        }
    }
?>