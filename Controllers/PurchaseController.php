<?php

namespace Controllers;

use Exception;
use DAO\CinemaDAOMSQL;
use DAO\MovieShowDAOMSQL;
use DAO\PurchaseDAOMSQL;
use DAO\SeatDAOMSQL;
use DAO\TicketDAOMSQL;
use DAO\UserDAOMSQL;
use Models\Purchase;
use Models\Seat;
use Models\Ticket;
use Helpers\QR_BarCode as QR_BarCode;

class PurchaseController
{
    private $purchaseDAOMSQL;
    private $cinemaDAOMSQL;
    private $movieShowDAOMSQL;
    private $seatDAOMSQL;
    private $ticketDAOMSQL;
    private $userDAOMSQL;
    public function __construct()
    {
        $this->purchaseDAOMSQL = new PurchaseDAOMSQL;
        $this->cinemaDAOMSQL = new CinemaDAOMSQL;
        $this->movieShowDAOMSQL = new MovieShowDAOMSQL;
        $this->seatDAOMSQL = new SeatDAOMSQL;
        $this->ticketDAOMSQL = new TicketDAOMSQL;
        $this->userDAOMSQL = new UserDAOMSQL;
    }


    public function confirm($reserva = null)
    {
        require_once(VIEWS_PATH . "add-purchase.php");
    }

    public function showAddPurchase()
    {
        $purchase = null;
        $listTickets = null;
        if(isset($_SESSION['purchase'])){
           $purchase =  $_SESSION['purchase'];
           $listTickets = $purchase->getTickets();
        }
        
        
        
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
            $id=$this->ticketDAOMSQL->get_id($ticket->getMovieShow()->getId(),$ticket->getSeat()->getId());
            $ticket->setId($id);

            $this->mailTickets($ticket);
            
        }
        $purchase = null;
        $_SESSION['purchase'] = null;
        $listTickets = null;


        require_once (VIEWS_PATH."sold-tickets.php");
    }


    private function mailTickets($ticket){
        $user = $this->userDAOMSQL->getById($_SESSION['loggedUser']);
        $email = $user->getEmail();
        $filename=($this->generateQr($ticket));
        $this->ticketDAOMSQL->setQr($ticket->getId(),$filename);
        $para      = $email;
        $titulo    = 'Ticket comprado';
        $mensaje   = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ticket</title>
            <style>
                *{
                    padding: 0;
                    margin: 0;
                    box-sizing: border-box;
                }
                .content{
                    width:1000px;
                }
                .caja{
                    width: 100%;
                    height: 300px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
        
                .caja img{
                    width: 100px;
                }
        
                .caja table{
                    width: 100%;
                    height: 100%;
                }
                .caja table tbody{
                    width: 100%;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-around;
                    flex-flow: column;
                    background: #ccc;
                }
        
                tr{
                    width:100%;
                    display: flex;
                    align-items: center;
                    border-bottom: 2px solid #000;
        
                }
        
                td{
                   text-align: center;
                   width: 200px;
                   font-size:30px;
        
                }
                h2{
                    width:  100%;
                    text-align: center;
                    font-size: 40px;
                    background: brown;
                    color: #fff;
                    padding: 5px;
                }
        
                h1{
                    width: 100%;
                    color: #fff;
                    background: #333;
                }
                span{
                    color: brown;
                }
            </style>
        </head>
        <body>
            <div class="content">
                <h1>Multi<span>Flex</span></h1>
                <div class="caja">
                <img src="'. $ticket->getMovieshow()->getMovie()->getPoster() .'" alt="">
                <table>
                    
                    <tbody>
                        <tr>
                            <td>Pelicula</td>
                            <td>'. $ticket->getMovieshow()->getMovie()->getName() .'</td>
                        </tr>
        
                        <tr>
                            <td>Cinema</td>
                            <td>'. $ticket->getMovieshow()->getCinema()->getName() .'</td>
                        </tr>
        
                        <tr>
                            <td>Sala</td>
        
                            <td>'.$ticket->getMovieshow()->getRoom()->getName() .'</td>
                        </tr>
                        <tr>
                            <td>Fecha</td>
        
                            <td>'.$ticket->getMovieshow()->getDate() .'</td>
                        </tr>
                        <tr>
                            <td>Hora</td>
        
                            <td>'. $ticket->getMovieshow()->getTime() .'</td>
                        </tr>
                        <tr>
                            <td>Asiento</td>
        
                            <td>'. $ticket->getSeat()->getNumSeat()  .'</td>
                        </tr>
                        <tr>
                        <td>Costo</td>
    
                        <td>'. $ticket->getTicketCost()  .'</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h2>Presente el codigo QR para retirar la entrada</h2>
            </div>
        </body>
        </html>';
        $cabeceras = 'Content-type: text/html; charset=utf-8' . "\r\n";
        $cabeceras .= 'From: ' .$email. "\r\n" .
            'Reply-To:'. $email .'"\r\n" '.
            'X-Mailer: PHP/' . phpversion();
        //llamamos a la funcion q genera los QR
        /*
                aca me falta el guardado en el dao.. ya lo estoy viendo

                https://blog.unreal4u.com/2010/08/como-ocupar-ob_start-ob_get_contents-y-otros-relacionados/

                esta seria la opcion para traernos la imagen q guardamos en la carpeta TEMP

                y luego hay q updetear el ticket en el dao con la funcion q ya cree q se llama   setQr();
        */
        //mail($para,$titulo,$mensaje,$cabeceras);
        /*
                destruir la imagen de la carpeta temporal luego e haberla envioadop a la base de datos
        */
    }

    //genera el QR y lo guarda en una carpeta temporal
    private function generateQr($ticket){
        $filename =dirname(__DIR__)."\\Data\\temp\\"."qrnro".$ticket->getId().".png";
        $content="Nro Ticket: ".$ticket->getId()."/ Nombre Pelicula: ".$ticket->getMovieshow()->getRoom()->getName() .
        "/ Nro Asiento: ". $ticket->getSeat()->getNumSeat(). "/ Fecha: ".$ticket->getMovieshow()->getDate() .
        "/ Hora: ". $ticket->getMovieshow()->getTime() ."/ Costo Ticket: ". $ticket->getTicketCost();
        $type="png";
        try{
            $qr=new QR_BarCode;
            $qr->content($type,15,$content);
            $qr->qrCode(350,$filename);
        return $filename;
        }
        catch (Exception $ex){
            throw $ex;
        }
    }
}
