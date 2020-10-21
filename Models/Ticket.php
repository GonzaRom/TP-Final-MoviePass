<?php
    namespace Models;
    use Models\Seat as Seat;

    class Ticket{
        private $id;
        private $discount;
        private $seat;
        private $movieShow;
        private $idUser;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }
 
        public function getDiscount()
        {
            return $this->discount;
        }

        public function setDiscount($discount)
        {
            $this->discount = $discount;
            return $this;
        }

        public function getSeat()
        {
            return $this->seat;
        }

        public function setSeat($seat)
        {
            $this->seat = $seat;
            return $this;
        }

        public function setMovieShow($movieShow){
            $this->movieShow = $movieShow;
        }

        public function getMovieShow(){
            return $this->movieShow;
        }

        public function setUser($user){
            $this->idUser = $user;
        }

        public function getUser($user){
            $this->idUser;
        }
    }
?>