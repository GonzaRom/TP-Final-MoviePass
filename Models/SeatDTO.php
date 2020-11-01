<?php
    namespace Models;

    class SeatDTO{
        private $id;
        private $numAsiento;
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

        public function setMovieShow($movieShow){
            $this->movieShow = $movieShow;
        }

        public function getMovieShow(){
            return $this->movieShow;
        }
    }
?>