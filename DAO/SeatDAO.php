<?php

namespace DAO;

use Models\Seat;

class SeatDAO implements ISeatDAO{
    private $listSeat = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/Seat.json";
    }
   
    public function add(Seat $seat)
    {
        $this->retriveData();
        array_push($this->listSeat , $seat);
        $this->saveData();
    }

    public function getAll()
    {
        $this->retriveData();
        return $this->listSeat;
        
    }

    public function get($id)
    {
        $this->retriveData();
        $getSeat=null;
        foreach($this->listSeat as $seat){
            if($seat->getId() == $id){
                $getSeat = $seat;
            }
        }
    return $getSeat;
        
    }

    private function retriveData(){
        $this->listSeat = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $jsonDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

            foreach($jsonDecode as $seat){
                $newSeat  = new Seat();
                $newSeat->setId($seat['id']);
                $newSeat->setOccupied($seat['occupied']);
                $newSeat->setMovieShow($seat['movieShow']);

                array_push($this->listSeat,$newSeat);
            }
        }
    }

    private function saveData(){
        $jsonEncode = array();

        foreach($this->listSeat as $seat){
            $valuesSeat = array();

            $valuesSeat['id']=$seat->getId();
            $valuesSeat['occupied']=$seat->getOccupied();
            $valuesSeat['movieShow']=$seat->getMovieShow();

            array_push($jsonEncode , $valuesSeat);
        }

        $jsonContent = json_encode( $jsonEncode , JSON_PRETTY_PRINT);

        file_put_contents($this->fileName , $jsonContent);
    }
}


?>