<?php

namespace Controllers;

use DAO\GenreDAOMSQL as GenreDAOMSQL;
use DAO\MovieDAO as MovieDAO;
use DAO\MovieShowDAOMSQL as MovieShowDAO;
use DAO\CinemaDAOMSQL as CinemaDAOMSQL;
use DAO\RoomDAOMSQL as RoomDAO;
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use Models\MovieShowDTO as MovieShowDTO;
use DAO\MovieDAOMSQL as MovieDAOMSQL;

class HomeController
{
    private $movieDAO;
    private $movieDAOMSQL;
    private $genreDAO;
    private $movieShowDAO;
    private $cinemaDAO;
    private $roomDAO;
    private $typeMovieShowDAO;
    

    public function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->movieDAOMSQL = new MovieDAOMSQL();
        $this->genreDAO = new GenreDAOMSQL();
        $this->movieShowDAO = new MovieShowDAO();
        $this->cinemaDAO = new CinemaDAOMSQL();
        $this->movieDAO = new MovieDAO();
        $this->roomDAO = new RoomDAO();
        $this->typeMovieShowDAO = new TypeMovieShowDAO();
    }

    // se llaman a las vistas de home.php.
    public function index($message = "", $movieList = null)
    {   $movieShows = $this->movieShowDAO->getAllActive(); // trae todas las funciones disponibles.
        if ($movieList == null) {
            
            $movieList = $this->movieDAOMSQL->getAll();
            //$this->genreDAO->updateFromApi();
            //$this->movieDAOMSQL->updateFromApi();
            if (empty($movieShows)) {
                //Por hacer:
                //return require_once(VIEWS_PATH."error_404.php");  
                $message = "E R R O R, No existen funciones pendientes.";
            }
        }

        /*$para      = 'isaiasemanuelcalfin@hotmail.com';
        $titulo    = 'Acceso a la plataforma';
        $mensaje   = 'Accedieron a la plataforma';
        $cabeceras = 'From: isaiasemanuelcalfin@hotmail.com' . "\r\n" .
            'Reply-To: isaiasemanuelcalfin@hotmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        $valido=mail($para,$titulo,$mensaje,$cabeceras);*/
        require_once(VIEWS_PATH . "home.php");
    }

    //trae Todas las movieShow y la almacena en un un array de movieShowDTO.
    private function getMovieShowList()
    {
        $movieShows = $this->movieShowDAO->getAllActive();
        $listMovieShow = array();
        foreach ($movieShows as $movieShow) {
            $movieShowDTO = new MovieShowDTO();
            $movieShowDTO->setId($movieShow->getId());
            $movieShowDTO->setDate($movieShow->getDate());
            $movieShowDTO->setTime($movieShow->getTime());
            $movieShowDTO->setMovie($this->movieDAO->get($movieShow->getMovie()));
            $billBoard = $this->billBoardDAO->get($movieShow->getBillBoard());
            //$cinema = $this->cinemaDAO->get($billBoard->getCinema());
            // $movieShowDTO->setNameCinema($cinema->getName());
            $room = $this->roomDAO->get($movieShow->getRoom());
            //$movieShowDTO->setRoomName($room->getName());
            $movieShowDTO->setTypeMovieShow($this->typeMovieShowDAO->getName($movieShow->getTypeMovieShow()));

            array_push($listMovieShow, $movieShowDTO);
        }
        return $listMovieShow;
    }

    public function filterByGenres()
    {
        $movieList = array();
        if (isset($_GET['genre'])) {
            $movieList = $this->movieDAOMSQL->getMoviesByGenre($_GET['genre']);
        }

        $this->index("" , $movieList);
    }

    public function filterByGenre()
    {
        $movieList = array();
        if (isset($_GET['genre'])) {
            $movieList = $this->movieDAOMSQL->getMoviesByGenre($_GET['genre']);
            foreach ($movieList as $movie) {
                echo '<div class="movie">';
                echo '<div class="img-poster-movie">';
                echo '<img src="' . $movie->getPoster() . '" alt="">';
                echo '</div>';
                echo '<div class="detalles">';
                echo '<h2>' . $movie->getName() . '</h2>';
                echo '<a href="">Reservar</a>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
}
