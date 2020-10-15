<?php
    namespace Models;
    use Models\Seat as Seat;

    class Ticket{
        private $id;
        private $datetime;
        private $discount;
        private $seats;

        public function __construct(){
            $this->seats=array();
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

        public function getDateTime()
        {
            return $this->datetime;
        }

        public function setDateTime($datetime)
        {
            $this->datetime = $datetime;
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

        public function getSeats()
        {
            return $this->seats;
        }

        public function setSeats($seats)
        {
            $this->seats = $seats;
            return $this;
        }
    }
?>