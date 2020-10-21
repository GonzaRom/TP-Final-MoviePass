<?php 
namespace Models;

class MovieShowDTO{
    private $id;
    private $movie;
    private $nameCinema;
    private $typeMovieShow;
    private $roomName;
    private $seats;
    private $date;
    private $time;


    public function __construct()
    {
    }

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

    public function getNameCinema()
    {
        return $this->nameCinema;
    }

    public function setNameCinema($nameCinema)
    {
        $this->nameCinema = $nameCinema;
    }

    public function getTypeMovieShow()
    {
        return $this->typeMovieShow;
    }

    public function setTypeMovieShow($typeMovieShow)
    {
        $this->typeMovieShow = $typeMovieShow;
    }

    public function getRoomName()
    {
        return $this->roomName;
    }

    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;
    }

    public function getSeats()
    {
        return $this->seats;
    }

    public function setSeats($seats)
    {
        $this->seats = $seats;
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
}