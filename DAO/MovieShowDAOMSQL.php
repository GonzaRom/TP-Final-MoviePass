<?php

namespace DAO;

use Exception;
use Models\Movie;
use Models\MovieShow;

class MovieShowDAOMSQL implements IMovieShowDAO
{
    private $nameTable= "movieshows";
    private $conection;

    public function add(MovieShow $newMovieShow)
    {
        try{
            $sql = "INSERT INTO ".$this->nameTable. " (idmovie , idbillboard , idtypemovieshow , idroom , date_ , time_ , isactive )
            VALUES (:idmovie , :idbillboard , :idtypemovieshow , :idroom , :date_ , :time_ , :isactive)";

            $parameters['idmovie']= $newMovieShow->getMovie();
            $parameters['idbillboard']=$newMovieShow->getBillBoard();
            $parameters['idtypemovieshow'] = $newMovieShow->getTypeMovieShow();
            $parameters['idroom']=$newMovieShow->getRoom();
            $parameters['date_'] = $newMovieShow->getDate();
            $parameters['time_'] = $newMovieShow->getTime();
            $parameters['isactiveMovieShow'] = $newMovieShow->getIsActive();
            $this->conection = Connection :: getInstance();
            $this->conection->ExecuteNonQuery($sql , $parameters);

        }catch(Exception $ex){
            throw $ex;
        }
    }
    public function getAll()
    {
        try{
            $sql= "SELECT * FROM ". $this->nameTable. "as m INNER JOIN movies as mo ON m.idmovie = mo.idmovie ";
            $parameters['isactive'] = true;
            $listMovieShow = array();
            $this->conection = Connection :: getInstance();
            $result = $this->conection->Execute($sql , $parameters);
            foreach($result as $movieShow){
                $newMovieShow = new MovieShow();
                $newMovie = new Movie();
                $newMovie->setId($movieShow['idmovie']);
                $newMovie->setImdbID($movieShow['imdbid']);
                $newMovie->setName($movieShow['namemovie']);
                $newMovie->setSynopsis($newMovieShow['synopsis']);
                $newMovie->setPoster($newMovieShow['poster']);
                $newMovie->setBackground($newMovieShow['background']);
                $newMovie->setVoteAverage($newMovieShow['voteAverage']);
                $newMovie->setRunTime($newMovieShow['runtime']);
                $newMovie->setIsactive($newMovieShow['isactive']);
                $newMovieShow->setId($movieShow['idmovieshow']);
                $newMovieShow->setMovie($newMovie);
                $newMovieShow->setRoom($movieShow['idroom']);
                $newMovieShow->setBillBoard($movieShow['idbillboard']);
                $newMovieShow->setDate($movieShow['date_']);
                $newMovieShow->setTime($movieShow['time_']);

                array_push($listMovieShow , $newMovieShow);
            }

            return $listMovieShow;

        }catch(Exception $ex){
            throw $ex;
        }
    }
    public function remove($id)
    {
        $this->retriveData();
        $this->removeItem($id);
        $this->saveData();
    }
    public function get($id)
    {
        $this->retriveData();
        return $this->getItem($id);
    }

    public function getByMovie($idMovie)
    {
        $listByMovie = array();
        $this->retriveData();
        foreach ($this->listMovieShow as $movieShow) {
            if ($movieShow->getMovie() == $idMovie) {
                array_push($listByMovie, $movieShow);
            }
        }
        return $listByMovie;
    }

    public function getByCinema($idCinema)
    {
        $movieShowByCinema = array();
        $this->retriveData();
        foreach ($this->listMovieShow as $movieShow) {
            if ($movieShow->getCinema() == $idCinema) {
                array_push($movieShowByCinema, $movieShow);
            }
        }
        return $movieShowByCinema;
    }

    private function retriveData()
    {
        $this->listMovieShow = array();
        if (file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($jsonDecode as $movieShow) {
                $newMovieShow = new MovieShow();
                $newMovieShow->setId($movieShow['id']);
                $newMovieShow->setMovie($movieShow['movie']);
                $newMovieShow->setBillBoard($movieShow['billBoard']);
                $newMovieShow->setRoom($movieShow['room']);
                $newMovieShow->setDate($movieShow['date']);
                $newMovieShow->setTime($movieShow['time']);
                $newMovieShow->setTypeMovieShow($movieShow['typeMovieShow']);
                array_push($this->listMovieShow, $newMovieShow);
            }
        }
    }

    private function saveData()
    {
        $jsonEncode = array();

        foreach ($this->listMovieShow as $movieShow) {
            $valuesMovieShow = array();
            $valuesMovieShow['id'] = $movieShow->getId();
            $valuesMovieShow['movie'] = $movieShow->getMovie();
            $valuesMovieShow['billBoard'] = $movieShow->getBillBoard();
            $valuesMovieShow['room'] = $movieShow->getRoom();
            $valuesMovieShow['date'] = $movieShow->getDate();
            $valuesMovieShow['time'] = $movieShow->getTime();
            $valuesMovieShow['typeMovieShow'] = $movieShow->getTypeMovieShow();
            array_push($jsonEncode, $valuesMovieShow);
        }

        $jsonContent = json_encode($jsonEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    private  function removeItem($id)
    {
        foreach ($this->listMovieShow as $movieShow) {
            if ($movieShow->getId() == $id) {
                unset($this->listMovieShow, $movieShow);
            }
        }
    }

    private  function getItem($id)
    {
        $getMovieShow = null;
        foreach ($this->listMovieShow as $movieShow) {
            if ($movieShow->getId() == $id) {
                $getMovieShow = $movieShow;
            }
        }
        return $getMovieShow;
    }
}
?>