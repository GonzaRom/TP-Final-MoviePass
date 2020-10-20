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

    public function showAddMovieShowView($message = "")
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
                $objeto_DateTime = date_create_from_format('Y-m-d', $date);
                $newdate = date_format($objeto_DateTime, "d/m/Y");
                $newMovieShow->setDate($newdate);
                $newMovieShow->setTime($time);
                $this->movieShowDAO->add($newMovieShow);
            } else {
                $this->showAddMovieShowView(2);
            }
        } else {
            $this->showAddMovieShowView(1);
        }

        $this->showAddMovieShowView(3);
    }

    public function getAll()
    {
        $listMovie = $this->movieDAO->getAll();
        $listMovieShow = $this->movieShowDAO->getAll();
        require_once(VIEWS_PATH . "list-movies.php");
    }
    public function showListMovieShowView()
    {
        $listSeat = $this->seatDAO->GetAll();
        $listMovieShow = $this->movieShowDAO->getAll();
        $listCinema = $this->cinemaDAO->getAll();
        $listSeatMovieShow = array();
        $listRoom = $this->roomDAO->getAll();
        $listMovie = $this->movieDAO->getAll();
        foreach ($listMovieShow as $movieShow) {

            foreach ($listCinema as $cinema) {
                if ($cinema->getId() == $movieShow->getCinema()) {
                    $movieShow->setCinema($cinema->getName());
                    foreach ($listRoom as $room) {

                        if ($room->getId() == $movieShow->getRoom()) {
                            $movieShow->setRoom($room->getName());
                            $listSeatMovieShow = $this->create_array($room->getCapacity());
                            $id = 1;
                            $newArray = array();
                            foreach ($listSeatMovieShow as $seat) {

                                $seat = new Seat();
                                $seat->setMovieShow($movieShow->getId());
                                $seat->setId($id);
                                $id++;
                                array_push($newArray, $seat);
                            }

                            $listSeatMovieShow = $newArray;


                            foreach ($listSeat as $seat) {

                                if ($seat->getMovieShow() == $movieShow->getId()) {
                                    $listSeatMovieShow[$seat->getId() - 1] = $seat;
                                }
                            }
                        }
                    }
                }
            }
            $movieShow->setSeat($listSeatMovieShow);
        }

        require_once(VIEWS_PATH . "list-movieShow.php");
    }

    private  function create_array($num_elements)
    {
        $seat = new Seat();
        $seat->setOccupied(false);
        return array_fill(0, $num_elements, $seat);
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

    private function getCapacity($idRoom)
    {
        $listRoom = $this->roomDAO->getAll();
        $capacity = 0;
        foreach ($listRoom as $room) {
            if ($room->getId() == $idRoom) {
                $capacity = $room->getCapacity();
            }
        }
        return $capacity;
    }
}
