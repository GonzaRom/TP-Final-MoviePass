<?php

namespace Controllers;

use DAO\CinemaDAOMSQL;
use DAO\MovieShowDAOMSQL;
use DAO\PurchaseDAOMSQL;
use DAO\SeatDAOMSQL;
use Models\Purchase;
use Models\Ticket;

class PurchaseController{
    private $purchaseDAOMSQL;
    private $cinemaDAOMSQL;
    private $movieShowDAOMSQL;
    private $seatDAOMSQL;
    public function __construct()
    {
        $this->purchaseDAOMSQL = new PurchaseDAOMSQL;
        $this->cinemaDAOMSQL= new CinemaDAOMSQL;
        $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
        $this->seatDAOMSQL = new SeatDAOMSQL;
    }


    public function showAddView($cinema , $movieshow){

        echo $cinema;
        echo $movieshow;
        $cinema = $this->cinemaDAOMSQL->get($cinema);
        $movieshow = $this->movieShowDAOMSQL->get($movieshow);
        $cinema->setBillBoard($movieshow);
        
        require_once(VIEWS_PATH."add-purchase.php");
    }

    public function add(){


    }

    public function createTickets($cinema,  $idMovieshow , $seats){

        $time = time();
        $today = date('Y-m-d');
        $timeNow = date('H:i:s' , $time);
        $idUser = $_SESSION['loggedUser'];
        $newPurchase = new Purchase;

        foreach($seats as $seat){
           $newTicket = new Ticket();
           $newTicket->setDate($today);
           $newTicket->setTime($timeNow);
           $newTicket->setMovieshow($idMovieshow);
        }
    }
}
