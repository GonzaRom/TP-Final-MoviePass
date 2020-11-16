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
use PHPMailer\PHPMailer;
use PHPMailer\SMTP;
use PHPMailer\Exception as MailerExpetion;

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
        if (isset($_SESSION['purchase'])) {
            $purchase =  $_SESSION['purchase'];
            $listTickets = $purchase->getTickets();
        }
        require_once(VIEWS_PATH . "sold-tickets.php");
    }

    public function createTickets($idMovieshow, $seats)
    {
        if (empty($seats)) $this->confirm("No puede realizar una compra sin eleguir un asiento!");

        if (!isset($_SESSION['purchase'])) {
            $this->newPurchase($idMovieshow, $seats);
        } else {
            $this->addTickets($idMovieshow, $seats, $_SESSION['purchase']);
        }
        $reserva = "Reserva Confirmada";
        $this->confirm($reserva);
    }


    private function newPurchase($idMovieshow, $seats)
    {
        $tickets = array();
        $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
        $idUser = $_SESSION['loggedUser'];
        $newPurchase = new Purchase;
        $newPurchase->setIdUser($idUser);
        $costPurchase = $movieshow->getRoom()->getTicketCost() * count($seats);
        setlocale(LC_TIME, "spanish");
        $currentDay = date("l");
        if (($currentDay == "Wednesday" || $currentDay == "Tuesday") && count($seats) >= 2) {
            $costPurchase = $costPurchase * 0.75;
        }
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

    private function addTickets($idMovieshow, $seats, $purchase)
    {
        $tickets = $purchase->getTickets();
        $movieshow = $this->movieShowDAOMSQL->get($idMovieshow);
        $idUser = $_SESSION['loggedUser'];
        $cost = ($movieshow->getRoom()->getTicketCost() * count($seats)) + $purchase->getCosto();
        foreach ($seats as $seat) {
            $newTicket = new Ticket();
            $newTicket->setMovieshow($movieshow);
            $newTicket->setSeat($seat);
            $newTicket->setUser($idUser);
            $newTicket->setTicketCost($movieshow->getRoom()->getTicketCost());
            array_push($tickets, $newTicket);
        }

        $purchase->setTickets($tickets);

        setlocale(LC_TIME, "spanish");
        $currentDay = date("l");
        if (($currentDay == "Wednesday" || $currentDay == "Tuesday") && count($purchase->getTickets()) >= 2) {
            $cost = $cost * 0.75;
            $purchase->setCosto($cost);
        }
        $_SESSION['purchase'] = $purchase;
    }

    private function validateCreditCard($creditnumber, $expire, $verifcod, $nombre)
    {
        $flag = true;
        $today = date('Y-m-d');
        if (strlen($creditnumber) != 16) {
            echo "1";
            $flag = false;
        } else {
            if ($expire < $today) {
                $flag = false;
                echo "2";
            } else {
                if (strlen($verifcod) != 3) {
                    $flag = false;
                    echo "3";
                } else {
                    if (empty($nombre)) {
                        $flag = false;
                        echo "4";
                    }
                }
            }
        }
        return $flag;
    }

    public function addPurchase($nombre, $creditnumber, $verifcod, $expire)
    {
        if ($this->validateCreditCard($creditnumber, $expire, $verifcod, $nombre)) {
            $time = time();
            $today = date('Y-m-d');
            $timeNow = date('H:i:s', $time);
            $purchase = $_SESSION['purchase'];
            $purchase->setDate($today);
            $purchase->setTime($timeNow);
            $tickets = $purchase->getTickets();
            $this->purchaseDAOMSQL->add($purchase);
            $purchase = $this->purchaseDAOMSQL->getPurchase($purchase->getIdUser(), $purchase->getDate(), $purchase->getTime());
            foreach ($tickets as $ticket) {
                $newSeat = new Seat();
                $newSeat->setMovieShow($ticket->getMovieShow()->getId());
                $newSeat->setNumSeat($ticket->getSeat());
                $this->seatDAOMSQL->add($newSeat);
                $ticket->setSeat($this->seatDAOMSQL->getSeat($ticket->getMovieShow()->getId(), $ticket->getSeat()));
                $ticket->setPurchase($purchase->getId());
                $this->ticketDAOMSQL->add($ticket);
                $id = $this->ticketDAOMSQL->get_id($ticket->getMovieShow()->getId(), $ticket->getSeat()->getId());
                $ticket->setId($id);

                $this->mailTickets($ticket);
            }
            $purchase = null;
            $_SESSION['purchase'] = null;
            $listTickets = null;


            require_once(VIEWS_PATH . "sold-tickets.php");
        } else {
            $this->showAddPurchase();
        }
    }

    public function getByUser()
    {
        $id = $_SESSION['loggedUser'];
        $purchases = $this->purchaseDAOMSQL->getByUser($id);

        foreach ($purchases as $purchase) {
            $purchase->setTickets($this->ticketDAOMSQL->getByPurchase($purchase->getId()));
        }

        require_once(VIEWS_PATH . 'listPurchase.php');
    }

    public function getAllPurchase()
    {
        $cinemas = $this->cinemaDAOMSQL->getAll();
        $purchases = $this->purchaseDAOMSQL->getAll();

        foreach ($purchases as $purchase) {
            $purchase->setTickets($this->ticketDAOMSQL->getByPurchase($purchase->getId()));
        }
        $getAll = 1;

        require_once(VIEWS_PATH . 'listPurchase.php');
    }

    public function getByCinema($cinema = null)
    {
        $cinemas = $this->cinemaDAOMSQL->getAll();
        if ($cinema == 0) {
            $purchases = $this->purchaseDAOMSQL->getAll();
            foreach ($purchases as $purchase) {
                $purchase->setTickets($this->ticketDAOMSQL->getByPurchase($purchase->getId()));
            }
        } else {
            $purchases = $this->purchaseDAOMSQL->getByCinema($cinema);
            foreach ($purchases as $purchase) {
                $purchase->setTickets($this->ticketDAOMSQL->getByCinema($purchase->getId(), $cinema));
            }
        }



        $getAll = 1;

        require_once(VIEWS_PATH . 'listPurchase.php');
    }

    private function mailTickets($ticket)
    {
        $user = $this->userDAOMSQL->getById($_SESSION['loggedUser']);
        $email = $user->getEmail();
        $file = ($this->generateQr($ticket));
        $this->ticketDAOMSQL->setQr($ticket->getId(), $file['temp_name'], $file['code']);
        $this->sendMailFromHere($ticket, $file, $email);
    }

    //genera el QR y lo guarda en una carpeta temporal
    private function generateQr($ticket)
    {
        $filename = "qrnro" . $ticket->getId() . ".png";
        $ruta = dirname(__DIR__) . "\\Data\\temp\\";
        $temp_name = $ruta . "" . $filename;
        $code = $this->createCodQR();
        $content = "http://localhost/Projects/TP-Final-MoviePass/Ticket/deliverNewTicket?access=" . $code;
        $type = "png";
        try {
            $qr = new QR_BarCode;
            $qr->content($type, 15, $content);
            $qr->qrCode(350, $temp_name);
            $file['name'] = $filename;
            $file['temp_name'] = $temp_name;
            $file['size'] = filesize($temp_name);
            $file['code'] = $code;
            return $file;
        } catch (Exception $ex) {
            throw $ex;
        }
    }



    public function sendMailFromHere($ticket, $file, $address)
    {
        $mail = new PHPMailer(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        try {
            //Server settings
            $mail->SMTPDebug = 0;                  // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'isaiasemanuelcalfin@gmail.com';                     // SMTP username
            $mail->Password   = 'Familiacalfin22';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;
            $mail->Mailer = "smtp";                               // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('isaiasemanuelcalfin@gmail.com', 'Isaias');
            $mail->addAddress($address);     // Add a recipient

            // Attachments      
            // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Mensaje';
            $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="Content-Type" content="text/html"/>
                    <title>A Simple Responsive HTML Email</title>
                    <style type="text/css">
                    body {margin: 0; padding: 0; min-width: 100%!important;}
                    .content {width: 100%; max-width: 600px;}  
                    </style>
                </head>
                <body yahoo bgcolor="#fff">
                    <div width="100%" style="background:#333;"><h2 style="color:#fff">Multi<span style="color:red">flex</span></h2></div>
                    <table width="100%" bgcolor="#fff" border="2px solid #000" cellpadding="0" cellspacing="0" style="margin:10px;">
                        <tr>
                            <td>
                                <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td>
                                            Pelicula
                                        </td>
                                        <td>
                                            ' . $ticket->getMovieshow()->getMovie()->getName() . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cinema
                                        </td>
                                        <td>
                                           ' . $ticket->getMovieshow()->getCinema()->getName() . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sala
                                        </td>
                                        <td>
                                            ' . $ticket->getMovieshow()->getRoom()->getName() . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Fecha
                                        </td>
                                        <td>
                                            ' . $ticket->getMovieshow()->getDate() . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Horario
                                        </td>
                                        <td>
                                            ' . $ticket->getMovieshow()->getTime() . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Butaca
                                        </td>
                                        <td>
                                            ' . $ticket->getSeat()->getNumSeat() . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Costo de entrada
                                        </td>
                                        <td>
                                             ' . $ticket->getTicketCost() . '
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div width="100%" style="background:red; padding:5px;"><h3 style="color:#000">Presente el QR en ventanilla para obtener su entrada</h3></div>
                </body>
            </html>';
            $mail->addAttachment($file['temp_name'], $file['name']);
            $mail->send();
        } catch (MailerExpetion $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function createCodQR()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIKLMNOPQRSTUVWXYZ';
        $access =  substr(str_shuffle($permitted_chars), 0, 20);

        return $access;
    }
}
