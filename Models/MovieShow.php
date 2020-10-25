<?php

namespace Models;

class MovieShow
{
    private $id;
    private $movie;
    private $billBoard;
    private $typeMovieShow;
    private $room;
    private $date;
    private $time;
    private $active;
    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;
    }


    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function setListSeat($listSeat)
    {
        $this->listSeat = $listSeat;
    }


    public function getBillBoard()
    {
        return $this->billBoard;
    }

    public function setBillBoard($billBoard)
    {
        $this->billBoard = $billBoard;
    }

    public function setTypeMovieShow($typeMovieShow)
    {
        $this->typeMovieShow = $typeMovieShow;
    }

    public function getTypeMovieShow()
    {
        return $this->typeMovieShow;
    }

    public function setSeat($seat)
    {
        $this->seat = array();
        $this->seat = $seat;
    }

    public function getSeat()
    {
        return $this->seat;
    }

    public function setIsActive($active){
        $this->active = $active;
    }

    public function getIsActive(){
        return $this->active;
    }

    /* funcion q devuelve el dinero recaudado */
    public function getRisedMoney()
    {
        $risedmoney = 0; //variable donde almacenaremos al dinero q se va acumulando para luego retornarla como parametro
        foreach ($this->soldtickets as $ticket) {
            $price = $this->ticketcost * $ticket->getDiscount(); //la variable $price va a obtener el valor de la entradaindividual ya con el descuento aplicado
            $risedmoney = $risedmoney + ($price * count($ticket->getSeats()));
        }
        return $risedmoney;
    }
}
