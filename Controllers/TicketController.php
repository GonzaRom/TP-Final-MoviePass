<?php 
    namespace Controllers;

    use Helpers\IsAuthorize as IsAuthorize;
    use Exeption;
    use DAO\MovieShowDAOMSQL;
    use DAO\CinemaDAOMSQL;
    use DAO\SeatDAOMSQL;
    use DAO\TicketDAOMSQL as TicketDAOMSQL;
    
    class TicketController{

        private $ticketDAO;
        private $movieShowDAOMSQL;
        private $seatDAOMSQL;
        private $cinemaDAOMSQL;

        public function __construct()
        {
            $this->ticketDAO= new TicketDAOMSQL;
            $this->cinemaDAOMSQL= new CinemaDAOMSQL;
            $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
            $this->seatDAOMSQL = new SeatDAOMSQL;
        }

        public function showAddTicketView($idMovieshow){
            
            if(isset($_SESSION['loggedUser'])){
                if(isset($_SESSION['movieshow'])){
                    $_SESSION['movieshow'] = null;
                }
                $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
                $movieshow->setSeats($this->seatDAOMSQL->getSeats($idMovieshow , $movieshow->getRoom()->getCapacity()));
                require_once(VIEWS_PATH."add-purchase.php");
            }else{
                $_SESSION['movieshow'] = $idMovieshow;
                $message ="";
                require_once(VIEWS_PATH."login.php");
            }

        }

        public function showListTicket($idUser = 0){
            if($idUser != 0){
                $listTicket = $this->ticketDAO->getUser($idUser);
            }
            else{
                $listTicket= $this->ticketDAO->getAll();
            }

        require_once(VIEWS_PATH."list-ticket.php");
        }

        public function showHome($message=""){
            require_once(VIEWS_PATH."ticket-delivered.php");
        }

        public function deliverNewTicket($code){
            if(IsAuthorize::isauthorize()){
                try{
                    $message="no entro";
                    if($this->ticketDAO->deliverTicket($code)){
                        $message="se borro";
                    }
                    else{
                        $message="no se pudo borrar";
                    }
                    $this->showHome($message);
                }
                catch (Exeption $ex){
                    throw $ex;
                }
            }
        }
    }
?>