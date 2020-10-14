<?php 
    namespace Models;
    use Models\Ticket as Ticket;

    class MovieShow{
        private $id;
        private $movie;
        private $ticketcost;
        private $room;
        private $soldtickets;
        private $datetime;

        public function __Construct(){
            $soldtickets=array();
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

        
        public function GetTicketCost()
        {
            return $this->ticketcost;
        }
        
        public function SetTicketCost($ticketcost)
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
        
        public function GetSoldTickets()
        {
            return $this->soldtickets;
        }
    
        public function SetSoldTickets($soldtickets)
        {
            $this->soldtickets = $soldtickets;
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

        /* funcion q devuelve el dinero recaudado */
        public function GetRisedMoney(){
            $risedmoney=0;//variable donde almacenaremos al dinero q se va acumulando para luego retornarla como parametro
            foreach($this->soldtickets as $ticket){   
                $price=$this->ticketcost*$ticket->GetDiscount();//la variable $price va a obtener el valor de la entradaindividual ya con el descuento aplicado
                $risedmoney=$risedmoney+($price*count($ticket->GetSeats()));
            }   
            return$risedmoney;
        }
    }