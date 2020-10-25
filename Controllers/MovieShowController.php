<?php

namespace Controllers;

use DAO\MovieShowDAO as MovieShowDAO;
<<<<<<< HEAD
use DAO\CinemaDAOMSQL as CinemaDAO;
use DAO\RoomDAOMSQL as RoomDAO;
=======
use DAO\CinemaDAOMSQL as CinemaDAOMSQL;
use DAO\RoomDAOMSQL as RoomDAOMSQL;
>>>>>>> origin/Matias
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use DAO\SeatDAO as SeatDAO;
use Models\Seat as Seat;
use Models\MovieShow as MovieShow;
use Models\MovieShowDTO as MovieShowDTO;
<<<<<<< HEAD
use DAO\BillBoardDAO as BillBoardDAO;
use DAO\MovieDAOMSQL as MovieDAO;
=======
use DAO\BillBoardDAOMSQL as BillBoardDAOMSQl;
use DAO\MovieDAOMSQL as MovieDAOMSQL;
>>>>>>> origin/Matias

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
<<<<<<< HEAD
        $this->billBoardDAO = new BillBoardDAO();
        $this->movieDAO = new MovieDAO();
=======
        $this->billBoardDAO = new BillBoardDAOMSQL();
        $this->movieDAOMSQL = new MovieDAOMSQL();
>>>>>>> origin/Matias
        
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
        if (isset($_GET['cinema'])) {
            $listRoom = $this->roomDAO->getByCinema($_GET['cinema']);
            echo 'Sala:<select name="room" id="">';
            echo '<option value="">Seleccione una sala</option> ';
            foreach ($listRoom as $room) {
                if($room->getActive() == true){
                    echo '<option value="' . $room->getId() . '">' . $room->getName()  . '</option> ';
                }

                
            }
            echo '</select>';
        }
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
            ///validar que la pelicula no se este emitiendo el mismo dia en otro cine
        }

        if ($today <  $date) {
            if (!$exist) {
                $billBoard = $this->billBoardDAO->getByIdCinema($cinema);

                $newMovieShow->setId($this->movieShowId());
                $newMovieShow->setMovie($movie);
                $newMovieShow->setBillBoard($billBoard->getId());
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
        $listSeat = $this->seatDAO->GetAll();
        $movieShowsList = $this->movieShowDAO->getAll();
        $listCinema = $this->cinemaDAO->getAll();
        $listSeatMovieShow = array();
        $listRoom = $this->roomDAO->getAll();
        $listMovie = $this->movieDAOMSQL->getAll();
        $listMovieShow = array();
        foreach ($movieShowsList as $movieShow) {
            $movieShowDTO = new MovieShowDTO();
            $movieShowDTO->setId($movieShow->getId());
            $movieShowDTO->setDate($movieShow->getDate());
            $movieShowDTO->setTime($movieShow->getTime());
            $billBoard = $this->billBoardDAO->get($movieShow->getBillBoard());

            foreach ($listCinema as $cinema) {
                if ($cinema->getId() == $billBoard->getIdCinema()) {
                    $movieShowDTO->setNameCinema($cinema->getName());
                    foreach ($listRoom as $room) {
                        if ($room->getId() == $movieShow->getRoom()) {
                            $movieShowDTO->setRoomName($room->getName());
                            $movieShowDTO->setTypeMovieShow($this->typeMovieShowDAO->getName($movieShow->getTypeMovieShow()));
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
            $movieShowDTO->setSeats($listSeatMovieShow);
            array_push($listMovieShow, $movieShowDTO);
        }

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
                if ($cinema->getId() == $billBoard->getIdCinema()) {
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

?>