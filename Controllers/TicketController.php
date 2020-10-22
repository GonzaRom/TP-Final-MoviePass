<?php 
namespace Controllers;

use DAO\MovieShowDAO;
use DAO\TicketDAO;
use Models\Ticket;

class TicketController{

    private $ticketDAO;
    private $movieShowDAO;

    public function __construct()
    {
        $this->ticketDAO = new TicketDAO();
        $this->movieShowDAO =new MovieShowDAO();
    }

    public function showAddTicketView(){
        $listTicket = $this->ticketDAO->getAll();
        require_once(VIEWS_PATH.'add-purchase.php');
    }

    public function add($idMovieShow , $idSeat , $idUser, $discount){
        $newTicket = new Ticket();
        $newTicket->setMovieShow($idMovieShow);
        $newTicket->setSeat($idSeat);
        $newTicket->setUser($idUser);
        $newTicket->setDiscount($discount);

        $this->ticketDAO->add($newTicket);
        $this->showAddTicketView();
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