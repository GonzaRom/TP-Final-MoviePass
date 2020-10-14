<?php
    namespace Models;
    use Models\Seat as Seat;

    class Ticket{
        private $id;
        private $datetime;
        private $discount;
        private $seats;

        public function __Construct(){
            $this->seats=array();
        }

        public function GetId()
        {
            return $this->id;
        }

        public function SetId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function GetDateTime()
        {
            return $this->datetime;
        }

        public function SetDateTime($datetime)
        {
            $this->datetime = $datetime;
            return $this;
        }
 
        public function GetDiscount()
        {
            return $this->discount;
        }

        public function SetDiscount($discount)
        {
            $this->discount = $discount;
            return $this;
        }

        public function GetSeats()
        {
            return $this->seats;
        }

        public function SetSeats($seats)
        {
            $this->seats = $seats;
            return $this;
        }
    }
?>