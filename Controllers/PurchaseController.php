<?php

namespace Controllers;

use DAO\CinemaDAOMSQL;
use DAO\MovieShowDAOMSQL;
use DAO\PurchaseDAOMSQL;
use DAO\SeatDAOMSQL;

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

    public function createTickets($idUser,$cinema,  $idMovieshow , $seats){
        var_dump($cinema);
        var_dump($idMovieshow);
        var_dump($seats);

        foreach($seats as $seat){
            echo $seat . "  ";
        }
    }
}
