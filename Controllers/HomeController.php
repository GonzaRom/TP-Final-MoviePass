<?php

namespace Controllers;

use DAO\GenreDAO;
use DAO\MovieDAO as MovieDAO;
use DAO\MovieShowDAO as MovieShowDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use DAO\BillBoardDAO as BillBoardDAO;
use Models\MovieShowDTO as MovieShowDTO;

class HomeController
{
    private $movieDAO;
    private $genreDAO;
    private $movieShowDAO;
    private $cinemaDAO;
    private $roomDAO;
    private $typeMovieShowDAO;
    private $billBoardDAO;

    public function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->genreDAO = new GenreDAO();
        $this->movieShowDAO = new MovieShowDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
        $this->roomDAO = new RoomDAO();
        $this->typeMovieShowDAO = new TypeMovieShowDAO();
        $this->billBoardDAO = new BillBoardDAO();
    }
    public function index($message = "")
    {
        $movieShows = $this->getMovieShowList();
        if (empty($movieShows))
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");  
            $message = "E R R O R, No existen funciones pendientes.";
        else {
            $genreList = $this->genreDAO->getAll();
            require_once(VIEWS_PATH . "home.php");
        }
    }
    public function login()
    {
        require_once(VIEWS_PATH . "login.php");
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
            $movieShowDTO->setMovie($this->movieDAO->get($movieShow->getMovie()));
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
