<?php

namespace Controllers;

use DAO\CinemaDAOMSQL;
use DAO\MovieShowDAOMSQL;
use DAO\PurchaseDAOMSQL;
use DAO\SeatDAOMSQL;
use DAO\TicketDAOMSQL;
use Models\Purchase;
use Models\Seat;
use Models\Ticket;

class PurchaseController
{
    private $purchaseDAOMSQL;
    private $cinemaDAOMSQL;
    private $movieShowDAOMSQL;
    private $seatDAOMSQL;
    private $ticketDAOMSQL;
    public function __construct()
    {
        $this->purchaseDAOMSQL = new PurchaseDAOMSQL;
        $this->cinemaDAOMSQL = new CinemaDAOMSQL;
        $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
        $this->seatDAOMSQL = new SeatDAOMSQL;
        $this->ticketDAOMSQL = new TicketDAOMSQL;
    }


    public function confirm($reserva = null)
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
        if(!isset($_SESSION['purchase'])){
            $this->newPurchase($idMovieshow,$seats);
        }
        else{
            $this->addTickets($idMovieshow , $seats , $_SESSION['purchase']);
        }
        $reserva = "Reserva Confirmada";
        $this->confirm($reserva);
    }


    private function newPurchase($idMovieshow , $seats){
        $tickets = array();
        $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
        $idUser = $_SESSION['loggedUser'];
        $newPurchase = new Purchase;
        $newPurchase->setIdUser($idUser);
        $costPurchase = $movieshow->getRoom()->getTicketCost() * count($seats);
        $newPurchase->setCosto($costPurchase);
        foreach ($seats as $seat) {
            $newTicket = new Ticket();
            $newTicket->setMovieshow($movieshow);
            $newTicket->setSeat($seat);
            $newTicket->setUser($idUser);
            $newTicket->setTicketCost($movieshow->getRoom()->getTicketCost());
            array_push($tickets, $newTicket);
        }

        $newPurchase->setTickets($tickets);
        $_SESSION['purchase'] = $newPurchase;
    }

    private function addTickets($idMovieshow , $seats , $purchase){
        $tickets = $purchase->getTickets();
        $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
        $idUser = $_SESSION['loggedUser'];
        $cost = ($movieshow->getRoom()->getTicketCost() * count($seats)) + $purchase->getCosto();
        $purchase->setCosto($cost);
        foreach ($seats as $seat) {
            $newTicket = new Ticket();
            $newTicket->setMovieshow($movieshow);
            $newTicket->setSeat($seat);
            $newTicket->setUser($idUser);
            $newTicket->setTicketCost($movieshow->getRoom()->getTicketCost());
            array_push($tickets, $newTicket);
        }

        $purchase->setTickets($tickets);
        $_SESSION['purchase'] = $purchase;
    }

    public function addPurchase(){
        $time = time();
        $today = date('Y-m-d');
        $timeNow = date('H:i:s', $time);
        $purchase = $_SESSION['purchase'];
        $purchase->setDate($today);
        $purchase->setTime($timeNow);
        $tickets = $purchase->getTickets();
        $this->purchaseDAOMSQL->add($purchase);
        $purchase = $this->purchaseDAOMSQL->getPurchase($purchase->getIdUser() , $purchase->getDate() , $purchase->getTime());
        foreach($tickets as $ticket){
            $newSeat = new Seat();
            $newSeat->setMovieShow($ticket->getMovieShow()->getId());
            $newSeat->setNumSeat($ticket->getSeat());
            $this->seatDAOMSQL->add($newSeat);
            $ticket->setSeat($this->seatDAOMSQL->getSeat($ticket->getMovieShow()->getId() , $ticket->getSeat()));
            $ticket->setPurchase($purchase->getId());
            $this->ticketDAOMSQL->add($ticket);
        }

        require_once (VIEWS_PATH."sold-tickets.php");
    }
}
