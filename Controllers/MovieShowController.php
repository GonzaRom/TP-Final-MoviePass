<?php

namespace Controllers;

use DAO\MovieShowDAOMSQL as MovieShowDAO;
use DAO\CinemaDAOMSQL as CinemaDAOMSQL;
use DAO\RoomDAOMSQL as RoomDAOMSQL;
use DAO\TypeMovieShowDAO as TypeMovieShowDAO;
use DAO\SeatDAOMSQL as SeatDAO;
use Models\MovieShow as MovieShow;
use DAO\MovieDAOMSQL as MovieDAOMSQL;
use DateTime;
use Helpers\IsAuthorize as IsAuthorize; 
use Helpers\helper_rating;

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
        require_once(VIEWS_PATH."validated-usertype.php");
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
    public function add($movie, $cinema, $room, $typeMovieShow, $date, $time)/* funcion q corrobora si se puede agregar una funcion*/
    {   
        if(IsAuthorize::isauthorize()){
            $add=false;
            $listMS=$this->movieShowDAO->validateMovie($movie,$date);
            if(empty($listMS)){
                $add=true;
            }else{
                foreach($listMS as $movieshow){
                    if($movieshow->getRoom()==$room){
                        $add=true;
                    }
                }
            }
            if($add){
                $auxmovie=$this->movieDAOMSQL->get($movie);
                echo $time .' = hora de inicio<br>';
                echo $auxmovie->getRunTime() . ' = minutos a sumar<br>';
                $endObjt=new DateTime($time);
                $time = $endObjt->format('H:i');
                $strModify= '+' . $auxmovie->getRunTime(). ' minute';
                $endObjt->modify($strModify);
                $endObjt->modify('+15 minute');/* aca hayq ver como sumar la hora en esta variable end... y la usamos como parametro*/
                $end = $endObjt->format('H:i'). ' Horario total<br>';
                $listMShours=$this->movieShowDAO->validateTime($room,$time,$end,$date);
                if(empty($listMShours)){
                    $this->addMs($movie, $cinema, $room, $typeMovieShow, $date, $time, $end);
                }else{
                    $this->showAddMovieShowView(2);
                }
                
            }

        }
    }

    private function addMs($movie, $cinema, $room, $typeMovieShow, $date, $time ,$end)//esta funcion es la q agrega, la anterior es la q chekea
    {   
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
                $newMovieShow->setEndTime($end);
                $newMovieShow->setIsActive(true);
                $this->movieShowDAO->add($newMovieShow);
                $this->showAddMovieShowView();
            } else {
                $this->showAddMovieShowView(2);
            }
        }
               
        //FECHA ANTERIOR A HOY
        $this->showAddMovieShowView(2);
    }

    public function getAll($movieShows = null)
    {

        $cinemas = $this->cinemaDAO->getAll();
        if($movieShows == null ){
            $listMovieshow = $this->movieShowDAO->getAllActive();
        }else{
            $listMovieshow = $movieShows;
        }
        
        require_once(VIEWS_PATH . "list-movies.php");
    }

    public function showListMovieShowView()
    {
        if(IsAuthorize::isauthorize()){
            $cinemas = $this->cinemaDAO->getAll();
            foreach ($cinemas as $cinema) {
                $movieShows = $this->movieShowDAO->getMovieShowBycinema($cinema->getId());
                foreach ($movieShows as $movieShow) {
                    $movieShow->setSeats($this->seatDAO->getSeats($movieShow->getId(), $movieShow->getRoom()->getCapacity()));
                }
                $cinema->setBillboard($movieShows);
            }
        }

        require_once(VIEWS_PATH . "list-movieShow.php");
    }

    public function getByMovie($idMovie)
    {
        $movieshows = array();
        $movieShows = $this->movieShowDAO->getMovieShowByMovie($idMovie);
        $this->getAll($movieShows);
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
                    echo '<form action="'. FRONT_ROOT . 'Ticket/showAddTicketView" method="GET">';
                    echo '<div class="card mb-3" style="width:1250px;">';
                    echo '<div class="content-none" style="display: none;">';
                    echo '<input type="text" name="cinema" value="'.$cinema->getId().'">';
                    echo '<input type="text" name="movieshow" value="'.$movieShow->getId().'"></div>';
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
                    echo '<div class="col-md-2"><div class="content-list-reserv"><div class="list-reserv">';
                    echo helper_rating ::showRating($movieShow->getMovie()->getVoteAverage());
                    echo '<button type="submit" value="" class="btn btn-secondary btn-sm">Reservar</button>';
                    echo '<a type="button" href="'.FRONT_ROOT.'Movie/detailMovie?movie='.$movieShow->getMovie()->getId().'" class="btn btn-secondary btn-sm">Mas Info</a>
                    </div></div></div></div></div></form>';
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

    private function isMovieSetted($idMovie, $date)
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
