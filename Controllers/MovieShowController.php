<?php

namespace Controllers;

use DAO\MovieShowDAOMSQL as MovieShowDAO;
use DAO\CinemaDAOMSQL as CinemaDAOMSQL;
use DAO\RoomDAOMSQL as RoomDAOMSQL;
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use DAO\SeatDAOMSQL as SeatDAO;
use Models\MovieShow as MovieShow;
use DAO\MovieDAOMSQL as MovieDAOMSQL;

class MovieShowController
{

    private $movieShowDAO;
    private $cinemaDAO;
    private $roomDAO;
    private $typeMovieShowDAO;
    private $movieDAOMSQL;
    private $seatDAO;

    public function __construct()
    {
        $this->movieShowDAO = new MovieShowDAO();
        $this->cinemaDAO = new CinemaDAOMSQL();
        $this->roomDAO = new RoomDAOMSQL();
        $this->typeMovieShowDAO = new TypeMovieShowDAO();
        $this->seatDAO = new SeatDAO();
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
            echo 'Sala:<select name="room" id="" required="true">';
            echo '<option value="">Seleccione una sala</option> ';
            foreach ($listRoom as $room) {
                echo '<option value="' . $room->getId() . '">' . $room->getName()  . '</option> ';
            }
            echo '</select>';
        }
    }
    public function add($movie, $cinema, $room, $typeMovieShow, $date, $time)
    {
        if ($this->isMovieSetted($movie, $date)) $this->showAddMovieShowView(4);
        else {
            $this->movieDAOMSQL->upMovie($movie);
            $today = date('Y-m-d');
            $newMovieShow = new MovieShow();
            $exist = false;
            if ($today <  $date) {
                if (!$exist) {
                    $newMovieShow->setMovie($movie);
                    $newMovieShow->setCinema($cinema);
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
        //FECHA ANTERIOR A HOY
        $this->showAddMovieShowView(2);
    }

    public function getAll($cinemas = null)
    {
        if ($cinemas == null) {
            $cinemas = $this->cinemaDAO->getAll();
            /*if (empty($movieShows)) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");  
            $message = "E R R O R, No existen funciones pendientes.";
        }*/
            foreach ($cinemas as $cinema) {
                $cinema->setBillboard($this->movieShowDAO->getMovieShowBycinema($cinema->getId()));
            }
        }

        require_once(VIEWS_PATH . "list-movies.php");
    }



    public function showListMovieShowView()
    {
        $cinemas = $this->cinemaDAO->getAll();
        foreach ($cinemas as $cinema) {
            $movieShows = $this->movieShowDAO->getMovieShowBycinema($cinema->getId());
            foreach ($movieShows as $movieShow) {
                $movieShow->setSeats($this->seatDAO->getSeats($movieShow->getId(), $movieShow->getRoom()->getCapacity()));
            }
            $cinema->setBillboard($movieShows);
        }


        require_once(VIEWS_PATH . "list-movieShow.php");
    }

    public function getByMovie($idMovie)
    {
        $cinemas = array();
        if (!empty($idMovie)) {
            $cinemas = $this->cinemaDAO->getAll();
            foreach ($cinemas as $cinema) {
                $cinema->setBillboard($this->movieShowDAO->getMovieShowByMovie($cinema->getId(), $idMovie));
            }
        }
        $this->getAll($cinemas);
    }

    public function filterByCinema()
    {
        $cinemas = array();
        if (isset($_GET['billboard'])) {
            if ($_GET['billboard'] != 0) {
                $cinema = $this->cinemaDAO->get($_GET['billboard']);
                $cinema->setBillBoard($this->movieShowDAO->getMovieShowBycinema($cinema->getId()));
                array_push($cinemas, $cinema);
            } else {
                $cinemas = $this->cinemaDAO->getAll();
                foreach ($cinemas as $cinema) {
                    $cinema->setBillBoard($this->movieShowDAO->getMovieShowBycinema($cinema->getId()));
                }
            }
            foreach ($cinemas as $cinema) {
                foreach ($cinema->getBillBoard() as $movieShow) {
                    $movie = $movieShow->getMovie();
                    echo '<div class="row no-gutters">';
                    echo '<div class="col-md-2">';
                    echo '<img src="' . $movie->getPoster() . '" alt="..." class="card-img h-100" /></div>';
                    echo '<div class="col-md-8"><div class="card h-100"><div class="card-body"><h5 class="card-title text-center ">';
                    echo '<strong>' . $movie->getName() . '</strong></h5>';
                    foreach ($movie->getGenreId() as $genre) {
                        echo '  <span class="badge badge-info"> ' .  $genre->getName() . ' </span>  ';
                    }
                    echo  '<p class="card-text">' . $movie->getSynopsis() . '</td></p></div>';
                    echo '<div class="card-footer text-light bg-secondary"><p><span><strong>Cine:</strong> ' . $cinema->getName() . ' </span> ';
                    echo ' <span><strong>Sala:</strong> ' . $movieShow->getRoom()->getName() . ' </span> ';
                    echo  ' <span><strong>Proxima funcion:</strong> ' . $movieShow->getDate()  . '  ' . $movieShow->getTime() . ' </span> ';
                    echo ' <span><strong>Duracion:</strong> ' . $movie->getRunTime() . ' min</span> </p></div></div></div>';
                    echo '<div class="col-md-2"><div class="list-reserv"><small class="card-text"><i class="fas fa-star "></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></small>';
                    echo '<button type="submit" class="btn btn-secondary btn-sm" name="movieId" value="' . $movie->getId() . '">Reservar</button></div></div></div>';
                }
            }
        }
    }

    public function filterByDate()
    {
        $cinemas = array();
        if (isset($_GET['date'])) {
            $cinemas = $this->cinemaDAO->getAll();
            foreach ($cinemas as $cinema) {
                $cinema->setBillBoard($this->movieShowDAO->getMovieShowByMovieDate($cinema->getId(), $_GET['date']));
            }
        }
        $this->getAll($cinemas);
    }

    public function isMovieSetted($idMovie, $date)
    {
        $movieShows = array();
        $cinemas = $this->cinemaDAO->getAll();
        foreach ($cinemas as $cinema) {
            $movieShow = $this->movieShowDAO->getMovieShowByMovieDateCinema($idMovie, $date, $cinema->getId());
            if (!empty($movieShow)) return true;
        }
        return false;
    }
}
