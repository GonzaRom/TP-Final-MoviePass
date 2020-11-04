<?php 
namespace Controllers;

use DAO\MovieShowDAOMSQL;
use DAO\CinemaDAOMSQL;
use DAO\SeatDAOMSQL;

class TicketController{

    private $ticketDAO;
    private $movieShowDAO;
    private $seatDAOMSQL;

    public function __construct()
    {
        $this->cinemaDAOMSQL= new CinemaDAOMSQL;
        $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
        $this->seatDAOMSQL = new SeatDAOMSQL;
    }

    public function showAddTicketView($idcinema , $idMovieshow){
        $cinema = $this->cinemaDAOMSQL->get($idcinema);
        $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
        $movieshow->setSeats($this->seatDAOMSQL->getSeats($idMovieshow , $movieshow->getRoom()->getCapacity()));
        $cinema->setBillBoard($movieshow);
        require_once(VIEWS_PATH."add-purchase.php");
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

}



?>