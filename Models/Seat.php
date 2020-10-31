<?php
    namespace Models;

    class Seat{
        private $numAsiento;
        private $movieShow;

        public function getNumSeat()
        {
            return $this->numAsiento;
        }

        public function setNumSeat($numAsiento)
        {
            $this->numAsiento = $numAsiento;
        }

        public function setMovieShow($movieShow){
            $this->movieShow = $movieShow;
        }

        public function getMovieShow(){
            return $this->movieShow;
        }
    }
?>