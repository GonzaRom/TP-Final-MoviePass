<?php 
    namespace Models;

    class MovieShow{
        private $id;
        private $movie;
        private $ticketcost;
        private $room;
        private $soldseats;
        private $datetime;

        public function __Construct(){
            $soldseats=array();

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

    
        public function GetMovie()
        {
            return $this->movie;
        }

        
        public function SetMovie($movie)
        {
            $this->movie = $movie;
            return $this;
        }

        
        public function GetTicketcost()
        {
            return $this->ticketcost;
        }

        
        public function SetTicketcost($ticketcost)
        {
            $this->ticketcost = $ticketcost;
            return $this;
        }

        
        public function GetRoom()
        {
            return $this->room;
        }

        
        public function SetRoom($room)
        {
            $this->room = $room;
            return $this;
        }

        
        public function GetSoldseats()
        {
            return $this->soldseats;
        }

    
        public function SetSoldseats($soldseats)
        {
            $this->soldseats = $soldseats;
            return $this;
        }

        
        public function GetDatetime()
        {
            return $this->datetime;
        }

    
        public function SetDatetime($datetime)
        {
            $this->datetime = $datetime;
            return $this;
        }
    }
?>