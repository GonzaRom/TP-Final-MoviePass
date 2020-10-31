<?php

namespace Controllers;

use DAO\CinemaDAOMSQL;
use DAO\MovieShowDAOMSQL;
use DAO\PurchaseDAOMSQL;
use DAO\SeatDAOMSQL;
use Models\Purchase;
use Models\Ticket;

class PurchaseController
{
    private $purchaseDAOMSQL;
    private $cinemaDAOMSQL;
    private $movieShowDAOMSQL;
    private $seatDAOMSQL;
    public function __construct()
    {
        $this->purchaseDAOMSQL = new PurchaseDAOMSQL;
        $this->cinemaDAOMSQL = new CinemaDAOMSQL;
        $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
        $this->seatDAOMSQL = new SeatDAOMSQL;
    }


    public function confirm($reserva)
    {
        require_once(VIEWS_PATH . "add-purchase.php");
    }

    public function showAddPurchase()
    {
        $purchase = $_SESSION['purchase'];
        $listTickets = $purchase->getTickets();
        
        require_once (VIEWS_PATH."sold-tickets.php");

    }

    public function createTickets($idMovieshow, $seats)
    {
        
        $tickets = array();
        $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
        $time = time();
        $today = date('Y-m-d');
        $timeNow = date('H:i:s', $time);
        $idUser = $_SESSION['loggedUser'];
        $newPurchase = new Purchase;
        $newPurchase->setDate($today);
        $newPurchase->setTime($timeNow);
        $newPurchase->setIdUser($idUser);
        $costPurchase = $movieshow->getRoom()->getTicketCost() * count($seats);
        $newPurchase->setCosto($costPurchase);
        foreach ($seats as $seat) {
            $newTicket = new Ticket();
            $newTicket->setDate($today);
            $newTicket->setTime($timeNow);
            $newTicket->setMovieshow($movieshow);
            $newTicket->setSeat($seat);
            $newTicket->setUser($idUser);
            $newTicket->setTicketCost($movieshow->getRoom()->getTicketCost());
            array_push($tickets, $newTicket);
        }

        $newPurchase->setTickets($tickets);
        $_SESSION['purchase'] = $newPurchase;
        $reserva = "Reserva Confirmada";
        $this->confirm($reserva);
    }
}
