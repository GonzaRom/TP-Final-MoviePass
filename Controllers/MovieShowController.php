<?php

namespace Controllers;

use DAO\MovieShowDAOMSQL as MovieShowDAO;
use DAO\CinemaDAOMSQL as CinemaDAOMSQL;
use DAO\RoomDAOMSQL as RoomDAOMSQL;
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use DAO\SeatDAO as SeatDAO;
use Models\Seat as Seat;
use Models\MovieShow as MovieShow;
use Models\MovieShowDTO as MovieShowDTO;
use DAO\BillBoardDAOMSQL as BillBoardDAOMSQl;
use DAO\MovieDAOMSQL as MovieDAOMSQL;

class MovieShowController
{

    private $movieShowDAO;
    private $cinemaDAO;
    private $roomDAO;
    private $typeMovieShowDAO;
    private $seatDAO;
    private $billBoardDAO;
    private $movieDAOMSQL;

    public function __construct()
    {
        $this->movieShowDAO = new MovieShowDAO();
        $this->cinemaDAO = new CinemaDAOMSQL();
        $this->roomDAO = new RoomDAOMSQL();
        $this->typeMovieShowDAO = new TypeMovieShowDAO();
        $this->seatDAO = new SeatDAO();
        $this->billBoardDAO = new BillBoardDAOMSQL();
        $this->movieDAOMSQL = new MovieDAOMSQL();
    }

    public function showAddMovieShowView($message = "")
    {
        $listMovies = $this->movieDAOMSQL->getAll();
        $listCinema = $this->cinemaDAO->getAll();
        $listTypeMovieShow = $this->typeMovieShowDAO->getAll();
        require_once(VIEWS_PATH . "add-movieShow.php");
    }

    public function salas()
    {
        if (isset($_GET['cinema'])) {
            $listRoom = $this->roomDAO->getByCinema($_GET['cinema']);
            echo 'Sala:<select name="room" id="">';
            echo '<option value="">Seleccione una sala</option> ';
            foreach ($listRoom as $room) {
                echo '<option value="' . $room->getId() . '">' . $room->getName()  . '</option> ';
            }
            echo '</select>';
        }
    }
    public function add($movie, $billBoard, $room, $typeMovieShow, $date, $time)
    {
        $today = date('Y-m-d');
        $newMovieShow = new MovieShow();
        $exist = false;
        if ($today <  $date) {
            if (!$exist) {
                $newMovieShow->setMovie($movie);
                $newMovieShow->setBillBoard($billBoard);
                $newMovieShow->setRoom($room);
                $newMovieShow->setTypeMovieShow($typeMovieShow);
                $newMovieShow->setDate($date);
                $newMovieShow->setTime($time);
                $newMovieShow->setIsActive(true);
                $this->movieShowDAO->add($newMovieShow);
                $this->showAddMovieShowView();
            } else {
                $this->showAddMovieShowView(2);
            }
        }
    }

    public function getAll()
    {
        $movieShows = $this->getMovieShowList();
        if (empty($movieShows)) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");  
            $message = "E R R O R, No existen funciones pendientes.";
        }
        require_once(VIEWS_PATH . "list-movies.php");
    }
    public function showListMovieShowView()
    {
        $listMovieShow = $this->movieShowDAO->getAll();

        require_once(VIEWS_PATH . "list-movieShow.php");
    }

    public function getByMovie($idMovie)
    {

        $movieDTO = $this->movieDAOMSQL->get($idMovie);
        $genres = $movieDTO->getGenres();
        $listMovieShow = $this->movieShowDAO->getByMovie($idMovie);
        require_once(VIEWS_PATH . "detail-movie.php");
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

    private function getMovieShowList()
    {
        $movieShows = $this->movieShowDAO->getAll();
        $listCinema = $this->cinemaDAO->getAll();
        $listRoom = $this->roomDAO->getAll();
        $listMovieShow = array();
        foreach ($movieShows as $movieShow) {
            $movieShowDTO = new MovieShowDTO();
            $movieShowDTO->setId($movieShow->getId());
            $movieShowDTO->setDate($movieShow->getDate());
            $movieShowDTO->setTime($movieShow->getTime());
            $movieShowDTO->setMovie($this->movieDAOMSQL->get($movieShow->getMovie()));
            $billBoard = $this->billBoardDAO->get($movieShow->getBillBoard());

            foreach ($listCinema as $cinema) {
                if ($cinema->getId() == $billBoard) {
                    $movieShowDTO->setNameCinema($cinema->getName());
                    foreach ($listRoom as $room) {
                        if ($room->getId() == $movieShow->getRoom()) {
                            $movieShowDTO->setRoomName($room->getName());
                            $movieShowDTO->setTypeMovieShow($this->typeMovieShowDAO->getName($movieShow->getTypeMovieShow()));
                        }
                    }
                }
            }
            array_push($listMovieShow, $movieShowDTO);
        }
        return $listMovieShow;
    }
}
