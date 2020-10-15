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

        public function __construct(){
            $soldtickets=array();
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
    
        public function getMovie()
        {
            return $this->movie;
        }
        
        public function setMovie($movie)
        {
            $this->movie = $movie;
            return $this;
        }

        
        public function getTicketCost()
        {
            return $this->ticketcost;
        }
        
        public function setTicketCost($ticketcost)
        {
            $this->ticketcost = $ticketcost;
            return $this;
        }
        
        public function getRoom()
        {
            return $this->room;
        }
        
        public function setRoom($room)
        {
            $this->room = $room;
            return $this;
        }
        
        public function getSoldTickets()
        {
            return $this->soldtickets;
        }
    
        public function setSoldTickets($soldtickets)
        {
            $this->soldtickets = $soldtickets;
            return $this;
        }
        
        public function getDatetime()
        {
            return $this->datetime;
        }
    
        public function setDatetime($datetime)
        {
            $this->datetime = $datetime;
            return $this;
        }   

        /* funcion q devuelve el dinero recaudado */
        public function getRisedMoney(){
            $risedmoney=0;//variable donde almacenaremos al dinero q se va acumulando para luego retornarla como parametro
            foreach($this->soldtickets as $ticket){   
                $price=$this->ticketcost*$ticket->getDiscount();//la variable $price va a obtener el valor de la entradaindividual ya con el descuento aplicado
                $risedmoney=$risedmoney+($price*count($ticket->getSeats()));
            }   
            return$risedmoney;
        }
    }