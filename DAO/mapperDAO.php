<?php

namespace DAO;

use Models\Cinema;
use Models\Genre;
use Models\Movie;
use Models\MovieShowDTO;
use Models\RoomDTO;
use Models\SeatDTO;
use Models\Ticket;
use Models\TypeMovieShow;
use Models\TypeRoom;
use Models\User;

class mapperDAO
{

    private $connection;

    public static function mapearSeat($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $seat = new SeatDTO();
            $seat->setId($value['idseat']);
            $seat->setNumSeat($value['numseat']);
            $seat->setMovieShow($value['idmovieshow']);
            return $seat;
        }
    }

    public static function creatMovieShow($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $newMovieShow = new MovieShowDTO;
            $newMovieShow->setId($value['idmovieshow']);
            $newMovieShow->setMovie(mapperDAO::mapearMovie($value));
            $newMovieShow->setRoom(mapperDAO::mapearRoom($value));
            $newMovieShow->setTypeMovieShow(mapperDAO::mapearTypeMovieShow($value));
            $newMovieShow->setDate($value['date_']);
            $newMovieShow->setTime($value['time_']);
            return $newMovieShow;
        }
    }

    public static function creatMovieShowWithCinema($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $newMovieShow = new MovieShowDTO;
            $newMovieShow->setId($value['idmovieshow']);
            $newMovieShow->setMovie(mapperDAO::mapearMovie($value));
            $newMovieShow->setRoom(mapperDAO::mapearRoom($value));
            $newMovieShow->setTypeMovieShow(mapperDAO::mapearTypeMovieShow($value));
            $newMovieShow->setCinema(mapperDAO::mapearCinema($value));
            $newMovieShow->setDate($value['date_']);
            $newMovieShow->setTime($value['time_']);
            return $newMovieShow;
        }
    }

    public static function mapearCinema($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $newCinema = new Cinema();
            $newCinema->setName($value['namecinema']);
            echo $value['namecinema'];
            return $newCinema;
        }
    }

    public static function mapearRoom($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $newRoom = new RoomDTO();
            $newRoom->setId($value['idroom']);
            $newRoom->setName($value['nameroom']);
            $newRoom->setCapacity($value['capacity']);
            $newRoom->setTypeRoom(mapperDAO::mapearTypeRoom($value));
            $newRoom->setIsActive($value['isactiveMovieShow']);
            $newRoom->setTicketCost($value['ticketcost']);
            return $newRoom;
        }
    }

    public static function mapearTypeRoom($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $newTypeRoom = new TypeRoom();
            $newTypeRoom->setId($value['idtyperoom']);
            $newTypeRoom->setName($value['nametyperoom']);

            return $newTypeRoom;
        }
    }

    public static function mapearTypeMovieShow($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $newTypeRoom = new TypeMovieShow();
            $newTypeRoom->setId($value['idtypemovieshow']);
            $newTypeRoom->setName($value['nametypemovieshow']);

            return $newTypeRoom;
        }
    }

    public static function mapearMovie($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $movie = new Movie();
            $movie->setId($value["idmovie"]);
            $movie->setImdbID($value["imdbid"]);
            $movie->setName($value["namemovie"]);
            $movie->setSynopsis($value["synopsis"]);
            $movie->setPoster($value["poster"]);
            $movie->setBackground($value["background"]);
            $movie->setVoteAverage($value["voteAverage"]);
            $movie->setRunTime($value["runtime"]);
            $movie->setGenreId(mapperDAO::getGenresById($movie->getId()));
            return $movie;
        }
    }

    public static function getGenresById($idmovie)

    {
        $listGenres = array();
        $query = " SELECT * FROM genresxmovie as gxm INNER JOIN genres as g ON gxm.idgenre = g.idgenre WHERE gxm.idmovie = :idmovie";
        $parameters["idmovie"] = $idmovie;

        $connection = Connection::getInstance();
        $result = $connection->execute($query, $parameters);
        foreach ($result as $genres) {
            $newGenre = new Genre;
            $newGenre->setId($genres['idgenre']);
            $newGenre->setName($genres['namegenre']);
            array_push($listGenres, $newGenre);
        }
        return $listGenres;
    }

    public static function mapearTicket($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $ticket = new Ticket();
            $ticket->setId($value['idticket']);
            $ticket->setMovieShow($value['idmovieshow']);
            $ticket->setDate($value['date_']);
            $ticket->setTime($value['time_']);
            $ticket->setUser($value['iduser']);
            $ticket->setPurchase($value['idpurchase']);
            return $ticket;
        }
    }

    public static function mapearUser($value)
    {
        $value = ($value) ? $value : array();
        if (!empty($value)) {
            $user = new User();
            $user->setFirstname($value['username']);
            $user->setLastname($value['lastname']);
            return $user;
        }
    }
}
