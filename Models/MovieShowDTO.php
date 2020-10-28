<?php 
namespace Models;

class MovieShowDTO{
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

    public function setSeats($seat)
    {
        $this->seat = array();
        $this->seat = $seat;
    }

    public function getSeats()
    {
        return $this->seat;
    }

    public function setIsActive($active){
        $this->active = $active;
    }

    public function getIsActive(){
        return $this->active;
    }
}