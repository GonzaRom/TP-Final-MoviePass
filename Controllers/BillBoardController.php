<?php
namespace Controllers;

use Models\BillBoard as BillBoard;
use Models\BillBoardDTO as BillBoardDTO;
use Models\MovieShowDTO as MovieShowDTO;
use DAO\MovieShowDAO as MovieShowDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\BillBoardDAO as BillBoardDAO;

class BillBoardController
{
    private $movieShowDAO;
    private $cinemaDAO;
    private $billBoardDAO;

    public function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
        $this->movieShowDAO = new MovieShowDAO();
        $this->billBoardDAO = new BillBoardDAO();
    }

    public function add($message = ""){
        $listCinema = $this->cinemaDAO->getAll();
        require_once(VIEWS_PATH . "add-billboard.php");
    }

    public function addBillBoard($idCinema){
        echo $idCinema;
        $billBoard = new BillBoard();
        $billBoard->setId(1);
        $billBoard->setIdCinema($idCinema);
        $this->billBoardDAO->add($billBoard);
        
    }

    public function getAllByIdCinema($idCinema)
    {
        if ($idCinema == null || empty($idCinema)) return $message = "ERROR Id solo puede ser un numero entero.";
        $cinemaArray = $this->cinemaDAO->getAll();
        if (in_array($idCinema, $cinemaArray)) {
            $billBoardDTO = new BillBoardDTO();
            $billBoard = $this->billBoardDAO->getByIdCinema($idCinema);
            $billBoardDTO->setId($billBoard->getId());
            $billBoardDTO->setIdCinema($idCinema);
            $billBoardDTO->setMovieShows($this->getMovieShowList($idCinema));
            /**   
                 ACA va la vista que muestre solo las funciones del cine solicitado
            **/ 
        } else {
            //404 status code
            echo "E R R O R no existe el cinema";
        }
    }

    private function getMovieShowList($idCinema)
    {
        $movieShows = $this->movieShowDAO->getAll();
        $listCinema = $this->cinemaDAO->getAll();
        $listRoom = $this->roomDAO->getAll();
        $listMovieShow = array();
        foreach ($movieShows as $movieShow) {
            if ($movieShow->getCinema() == $idCinema) {
                $movieShowDTO = new MovieShowDTO();
                $movieShowDTO->setId($movieShow->getId());
                $movieShowDTO->setDate($movieShow->getDate());
                $movieShowDTO->setTime($movieShow->getTime());
                $movieShowDTO->setMovie($this->movieDAO->get($movieShow->getMovie()));
                foreach ($listCinema as $cinema) {
                    if ($cinema->getId() == $idCinema) {
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
        }
        return $listMovieShow;
    }
}
