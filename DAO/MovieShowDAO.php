<?php

namespace DAO;

use Models\MovieShow;

class MovieShowDAO implements IMovieShowDAO{
    private $listMovieShow = array();
    private $fileName ;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/MovieShow.json";
    }

    public function add(MovieShow $newMovieShow)
    {
        $this->retriveData();
        array_push($this->listMovieShow , $newMovieShow);
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
    public function get($id){
        $this->retriveData();
        return $this->getItem($id);

    }

    private function retriveData(){
        $this->listMovieShow = array();
        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();

            foreach($jsonDecode as $movieShow){
                $newMovieShow = new MovieShow();
                $newMovieShow->setId($movieShow['Id']);
                $newMovieShow->setMovie($movieShow['Movie']);
                $newMovieShow->setCinema($movieShow['Cinema']);
                $newMovieShow->setRoom($movieShow['Room']);
                $newMovieShow->setDate($movieShow['Date']);
                $newMovieShow->setTime($movieShow['Time']);
                $newMovieShow->setTypeMovieShow($movieShow['typeMovieShow']);

                array_push($this->listMovieShow , $newMovieShow);

            }
        }
        
    }

    private function saveData(){
        $jsonEncode = array();

        foreach($this->listMovieShow as $movieShow){
            $valuesMovieShow = array();
            $valuesMovieShow['Id']= $movieShow->getId();
            $valuesMovieShow['Movie'] = $movieShow->getMovie();
            $valuesMovieShow['Cinema'] = $movieShow->getCinema();
            $valuesMovieShow['Room'] = $movieShow->getRoom();
            $valuesMovieShow['Date'] = $movieShow->getDate();
            $valuesMovieShow['Time'] = $movieShow->getTime();
            $valuesMovieShow['typeMovieShow'] = $movieShow->getTypeMovieShow();
            
            array_push($jsonEncode,$valuesMovieShow);
            
        }

        $jsonContent = json_encode($jsonEncode , JSON_PRETTY_PRINT);
        file_put_contents($this->fileName , $jsonContent);
    }
    
    private  function removeItem($id){
        foreach($this->listMovieShow as $movieShow){
            if($movieShow->getId() == $id){
                unset($this->listMovieShow , $movieShow);
            }
        }
    }

    private  function getItem($id){
        $getMovieShow=null;
        foreach($this->listMovieShow as $movieShow){
            if($movieShow->getId() == $id){
                $getMovieShow = $movieShow;
            }
        }
    return $getMovieShow;
    }
}


?>