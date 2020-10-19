<?php

namespace Controllers;

use DAO\MovieShowDAO as MovieShowDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\MovieDAO as MovieDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use DAO\SeatDAO as SeatDAO;
use Models\Seat as Seat;
use Models\MovieShow as MovieShow;

class MovieShowController
{

    private $movieShowDAO;
    private $cinemaDAO;
    private $movieDAO;
    private $roomDAO;
    private $typeMovieShowDAO;
    private $seatDAO;

    public function __construct()
    {
        $this->movieShowDAO = new MovieShowDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
        $this->roomDAO = new RoomDAO();
        $this->typeMovieShowDAO = new TypeMovieShowDAO();
        $this->seatDAO = new SeatDAO();
    }

    public function showAddMovieShowView($message="")
    {
        $listMovies = $this->movieDAO->getAll();
        $listCinema = $this->cinemaDAO->getAll();
        $listTypeMovieShow = $this->typeMovieShowDAO->getAll();
        require_once(VIEWS_PATH . "add-movieShow.php");
    }

    public function salas()
    {

        $listRoom = $this->roomDAO->getAll();

        echo 'Sala:<select name="room" id="">';
        echo '<option value="">Seleccione una sala</option> ';
        if (isset($_GET['cinema'])) {
            foreach ($listRoom as $room) {
                if ($room->getCinema() == $_GET['cinema']) {
                    echo '<option value="' . $room->getId() . '">' . $room->getName()  . '</option> ';
                }
            }
        }

        echo '</select>';
    }

    public function add($movie, $cinema, $room, $typeMovieShow, $date, $time)
    {
        $today = date('Y-m-d');
        $newMovieShow = new MovieShow();
        $listMovieShow = $this->movieShowDAO->getAll();
        $exist = false;
        foreach ($listMovieShow as $movieShow) {
            if ($movieShow->getMovie() == $movie) {
                if ($movieShow->getCinema() == $cinema) {
                    if ($movieShow->getRoom() == $room) {
                        if ($movieShow->getTypeMovieShow() == $typeMovieShow) {
                            if ($movieShow->getDate() == $date) {
                                if ($movieShow->getTime() == $time) {
                                    $exist = true;
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($today <  $date) {
            if (!$exist) {
                $newMovieShow->setId($this->movieShowId());
                $newMovieShow->setMovie($movie);
                $newMovieShow->setCinema($cinema);
                $newMovieShow->setRoom($room);
                $newMovieShow->setTypeMovieShow($typeMovieShow);
                $newMovieShow->setDate($date);
                $newMovieShow->setTime($time);
                $this->createSeats($this->getCapacity($room) , $this->movieShowId());

                $this->movieShowDAO->add($newMovieShow);
                
            }else{
                $this->showAddMovieShowView(2); 
            }
        }else{
            $this->showAddMovieShowView(1); 
        }
        
        $this->showAddMovieShowView(3);
    }

    private function movieShowId()
    {
        $listMovieShow = $this->movieShowDAO->getAll();
        $id = 0;
        $lastMovieShow = end($listMovieShow);

        if (!empty($lastMovieShow)) {
            $id = $lastMovieShow->getId();
        }

        $id++;
        return $id;
    }

    private function createSeats($capacityRoom , $idMovieShow){
        
    for($i=0 ; $i<$capacityRoom ; $i++ ){
        $newSeat = new Seat();
        $newSeat->setId($this->seatID($idMovieShow));
        $newSeat->setMovieShow($idMovieShow);
        $this->seatDAO->add($newSeat);
    }
    }

    private function seatID($idMovieShow){
        $listseat = $this->seatDAO->getAll();
        $id = 0;
        $listseatMovieShow = array();
        foreach($listseat as $seat){
            if($seat->getMovieShow() == $idMovieShow){
                array_push($listseatMovieShow , $seat);
            }
        }

        $lastseat = end($listseatMovieShow);

        if (!empty($lastseat)) {
            $id = $lastseat->getId();
        }

        $id++;
        return $id;
    }

    private function getCapacity($idRoom){
        $listRoom = $this->roomDAO->getAll();
        $capacity =0;
        foreach($listRoom as $room){
            if($room->getId() == $idRoom){
                $capacity = $room->getCapacity();
            }
        }
    return $capacity;
    }
}
