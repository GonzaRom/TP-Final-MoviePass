<?php

namespace DAO;

use Models\MovieShow;
use Models\Seat;

class MovieShowDAO implements IMovieShowDAO
{
    private $listMovieShow = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__) . "/Data/MovieShow.json";
    }

    public function add(MovieShow $newMovieShow)
    {
        $this->retriveData();
        array_push($this->listMovieShow, $newMovieShow);
        $this->saveData();
    }
    public function getAll()
    {
        $this->retriveData();
        return $this->listMovieShow;
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
                $newMovieShow->setCinema($movieShow['cinema']);
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
            $valuesMovieShow['cinema'] = $movieShow->getCinema();
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
