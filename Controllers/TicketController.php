<?php 
    namespace Controllers;

    use Helpers\IsAuthorize as IsAuthorize;
    use Exeption;
    use DAO\MovieShowDAOMSQL;
    use DAO\CinemaDAOMSQL;
    use DAO\SeatDAOMSQL;
    use DAO\TicketDAOMSQL as TicketDAOMSQL;
use Exception;

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

        public function showHome($message="" , $acceso){
            $ticket = $this->ticketDAO->getByAccess($acceso);
            require_once(VIEWS_PATH."ticket_delivered.php");
        }

        public function deliverNewTicket($code){
            if(IsAuthorize::isauthorize()){
                try{
                    $message="no entro";
                    $this->ticketDAO->deliverTicket($code);
                    /*if($this->ticketDAO->deliverTicket($code)){
                        $message="se borro";
                        echo "hola 2";
                    }
                    else{
                        $message="no se pudo borrar";
                    }*/
                    $this->showHome($message , $code);
                }
                catch (Exception $ex){
                    throw $ex;
                }
            }
        }
    }
?>