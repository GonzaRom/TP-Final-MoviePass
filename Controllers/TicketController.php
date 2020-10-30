<?php 
namespace Controllers;

use DAO\MovieShowDAOMSQL;
use DAO\TicketDAO;
use Models\Ticket;
use DAO\CinemaDAOMSQL;

class TicketController{

    private $ticketDAO;
    private $movieShowDAO;

    public function __construct()
    {
        $this->cinemaDAOMSQL= new CinemaDAOMSQL;
        $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
    }

    public function showAddTicketView($cinema , $movieshow){
        $cinema = $this->cinemaDAOMSQL->get($cinema);
        $movieshow = $this->movieShowDAOMSQL->get($movieshow);
        $cinema->setBillBoard($movieshow);
        require_once(VIEWS_PATH."add-purchase.php");
    }

    /*public function add($idMovieShow , $idSeat , $idUser, $discount){
        $newTicket = new Ticket();
        $newTicket->setMovieShow($idMovieShow);
        $newTicket->setSeat($idSeat);
        $newTicket->setUser($idUser);
        $newTicket->setDiscount($discount);

        $this->ticketDAO->add($newTicket);
        $this->showAddTicketView();
    }*/
    public function showListTicket($idUser = 0){
        if($idUser != 0){
            $listTicket = $this->ticketDAO->getUser($idUser);
        }
        else{
            $listTicket= $this->ticketDAO->getAll();
        }

    require_once(VIEWS_PATH."list-ticket.php");
    }

}



?>