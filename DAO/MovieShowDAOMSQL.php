<?php

namespace DAO;

use Exception;
use Models\Genre;
use Models\Movie;
use Models\MovieShow;
use Models\MovieShowDTO;
use Models\RoomDTO;
use Models\TypeMovieShow;
use Models\TypeRoom;

class MovieShowDAOMSQL implements IMovieShowDAO
{
    private $nameTable = "movieshows";
    private $conection;

    public function add(MovieShow $newMovieShow)
    {
        try {
            $sql = "INSERT INTO " . $this->nameTable . " (idmovie , idbillboard , idtypemovieshow , idroom , date_ , time_ , isactiveMovieShow )
            VALUES (:idmovie , :idbillboard , :idtypemovieshow , :idroom , :date_ , :time_ , :isactiveMovieShow)";

            $parameters['idmovie'] = $newMovieShow->getMovie();
            $parameters['idbillboard'] = $newMovieShow->getBillBoard();
            $parameters['idtypemovieshow'] = $newMovieShow->getTypeMovieShow();
            $parameters['idroom'] = $newMovieShow->getRoom();
            $parameters['date_'] = $newMovieShow->getDate();
            $parameters['time_'] = $newMovieShow->getTime();
            $parameters['isactiveMovieShow'] = $newMovieShow->getIsActive();
            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function getAll()
    {
        $listMovieShow = array();
        try {
            $sql = "SELECT * FROM " . $this->nameTable . " as m 
            INNER JOIN typemovieshows as tm 
            ON m.idtypemovieshow = tm.idtypemovieshow
            INNER JOIN movies as mo
            ON m.idmovie = mo.idmovie 
            INNER JOIN rooms as r 
            ON m.idroom = r.idroom 
            INNER JOIN typerooms as t 
            ON r.idtyperoom = t.idtyperoom ";
            
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql);
        } catch (Exception $ex) {
            throw $ex;
        }

        if(!empty($result)){
            foreach($result as $movieShow){
                $newMovieShow = $this->creatMovieShow($movieShow);
                array_push($listMovieShow , $newMovieShow);
            }
        }
        return $listMovieShow;
    }

    public function getMovieShowBycinema($id)
    {
        try {
            $sql = "SELECT * FROM " . $this->nameTable . " as m 
            INNER JOIN typemovieshows as tm 
            ON m.idtypemovieshow = tm.idtypemovieshow
            INNER JOIN movies as mo
            ON m.idmovie = mo.idmovie 
            INNER JOIN rooms as r 
            ON m.idroom = r.idroom 
            INNER JOIN typerooms as t 
            ON r.idtyperoom = t.idtyperoom 
            WHERE m.idbillboard = :idbillboard";

            $parameters['idbillboard'] = $id;
            $listMovieShow = array();
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }

        if (!empty($result)) {
            foreach ($result as $movieShow) {

                $newMovieShow = $this->creatMovieShow($movieShow);
                array_push($listMovieShow, $newMovieShow);
            }
        }
        return $listMovieShow;
    }

    
    public function remove($id)
    {
    }
    public function get($id)
    {
    }


    public function getMovieShowByMovie($idMovie)
    {   $listMovieShow = array();
        try{
            
            $sql = "SELECT * FROM " . $this->nameTable ." as ms INNER JOIN movies as m ON ms.idmovie = m.idmovie WHERE ms.idmovie = :id";
            $parameters['id'] = $idMovie;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql , $parameters);
        }catch(Exception $ex){
            throw $ex;
        }

        if(!empty($result)){
            foreach($result as $movieShow){
                $newMovieShow = $this->creatMovieShow($movieShow);
                array_push($listMovieShow , $newMovieShow);
            }
        } 
        return $listMovieShow;

    }

    public function getMovieShowByMovieDate($idMovie , $date)
    {   $listMovieShow = array();
        try{
            
            $sql = "SELECT * FROM " . $this->nameTable ." as m 
            INNER JOIN typemovieshows as tm 
            ON m.idtypemovieshow = tm.idtypemovieshow
            INNER JOIN movies as mo
            ON m.idmovie = mo.idmovie 
            INNER JOIN rooms as r 
            ON m.idroom = r.idroom 
            INNER JOIN typerooms as t 
            ON r.idtyperoom = t.idtyperoom 
            WHERE m.idbillboard = :idbillboard AND m.date_ = :date";
            $parameters['idbillboard'] = $idMovie;
            $parameters['date'] =$date;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql , $parameters);
        }catch(Exception $ex){
            throw $ex;
        }

        if(!empty($result)){
            foreach($result as $movieShow){
                $newMovieShow = $this->creatMovieShow($movieShow);
                array_push($listMovieShow , $newMovieShow);
            }
        } 
        return $listMovieShow;

    }



    protected function creatMovieShow($value)
    {
        $value = ($value) ? $value : array();
        if(!empty($value)){
            $newMovieShow = new MovieShowDTO();
            $newMovieShow->setId($value['idmovieshow']);
            $newMovieShow->setMovie($this->mapearMovie($value));
            $newMovieShow->setRoom($this->mapearRoom($value));
            $newMovieShow->setTypeMovieShow($this->mapearTypeMovieShow($value));
            $newMovieShow->setDate($value['date_']);
            $newMovieShow->setTime($value['time_']);
            return $newMovieShow;
        }

        
    }


    protected function mapearRoom($value)
    {
        $value = ($value) ? $value : array();
        if(!empty($value)){
            $newRoom = new RoomDTO();
            $newRoom->setId($value['idroom']);
            $newRoom->setName($value['nameroom']);
            $newRoom->setCapacity($value['capacity']);
            $newRoom->setTypeRoom($this->mapearTypeRoom($value));
            $newRoom->setIsActive($value['isactive']);
            $newRoom->setTicketCost($value['ticketcost']);
            return $newRoom;
        }

        
    }

    protected function mapearTypeRoom($value)
    {
        $value = ($value) ? $value : array();
        if(!empty($value)){
            $newTypeRoom = new TypeRoom();
            $newTypeRoom->setId($value['idtyperoom']);
            $newTypeRoom->setName($value['nametyperoom']);

            return $newTypeRoom;
        }
    }

    protected function mapearTypeMovieShow($value)
    {
        $value = ($value) ? $value : array();
        if(!empty($value)){
            $newTypeRoom = new TypeMovieShow();
            $newTypeRoom->setId($value['idtypemovieshow']);
            $newTypeRoom->setName($value['nametypemovieshow']);

            return $newTypeRoom;
        }

        
    }

    protected function mapearMovie($value)
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
            $movie->setGenreId($this->getGenresById($movie->getId()));
            return $movie;
        }
    }

    public function getGenresById($idmovie)
    {
        $listGenres = array();
        $query = " SELECT * FROM genresxmovie as gxm INNER JOIN genres as g ON gxm.idgenre = g.idgenre WHERE gxm.idmovie = :idmovie";
        $parameters["idmovie"] = $idmovie;

        $this->connection = Connection::getInstance();
        $result = $this->connection->execute($query, $parameters);
        foreach ($result as $genres) {
            $newGenre = new Genre();
            $newGenre->setId($genres['idgenre']);
            $newGenre->setName($genres['namegenre']);
            array_push($listGenres, $newGenre);
        }
        return $listGenres;
    }
}
