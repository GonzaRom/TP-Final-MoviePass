<?php

namespace DAO;

use Exception;
use Models\Seat;
use Models\SeatDTO;

class SeatDAOMSQL implements ISeatDAO{
    private $conecction;
    private $nameTable = "seats";

    public function add(Seat $seat)
    {
        try{
            $query= "INSERT INTO ".$this->tableName. " (numasiento , occupied, idmovieshow) VALUES (:numasiento , :occupied , :idmovieshow);";
        
            $parameters['numasiento'] = $seat->getNumSeat();
            $parameters['occupied'] = true;
            $parameters['idmovieshow'] = $seat->getMovieShow();
            $this->conecction = Connection::getInstance();
            $this->conecction->executeNonQuery($query, $parameters);
    
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getAll()
    {
        try
            {
                $seatlist = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->conecction = Connection::getInstance();

                $resultSet = $this->conecction->Execute($query);
                    
                foreach ($resultSet as $row)
                {                
                    $seat = new SeatDTO();
                    $seat->setId($row['idseat']);
                    $seat->setNumSeat($row['numasiento']);
                    $seat->setOccupied($row['occupied']);
                    $seat->setMovieShow($row['idmovieshow']);
                        
                    array_push($seatlist, $seat);
                }

                return $seatlist;
                }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function get($id)
    {
        try{
            $seat=null;
            $sql = "SELECT * FROM ". $this->nameTable. " WHERE idseat= :idseat ;";
            $parameters['idseat']= $id;
            $this->conecction = Connection::getInstance();
            $resul = $this->conecction->Execute($sql ,$parameters);
            foreach($resul as $row){
                $seat= new SeatDTO();
                $seat->setId($row['idseat']);
                $seat->setNumSeat($row['numasiento']);
                $seat->setOccupied($row['occupied']);
                $seat->setMovieShow($row['idmovieshow']);
            }
            return $seat;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByMovieShow($id)
    {
        try{
            $seatlist = array();
            $sql = "SELECT * FROM ". $this->nameTable. " WHERE idmovieshow= :id ;";
            $parameters['id']= $id;
            $this->conecction = Connection::getInstance();
            $resul = $this->conecction->Execute($sql ,$parameters);
            foreach ($resul as $row)
            {                
                $seat = new SeatDTO();
                $seat->setId($row['idseat']);
                $seat->setNumSeat($row['numasiento']);
                $seat->setOccupied($row['occupied']);
                $seat->setMovieShow($row['idmovieshow']);
                    
                array_push($seatlist, $seat);
            }

            return $seatlist;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getSeats($idMovieShow , $cant){
        $seatList = $this->create_array($cant);
        $seatOcuped = $this->getByMovieShow($idMovieShow);

    
        for($i = 0 ; $i< count($seatList) ; $i++){
            $newSeat = new SeatDTO();
            $newSeat->setMovieShow(0);
            $newSeat->setNumSeat($i + 1);
            $newSeat->setOccupied(false);
            $seatList[$i] = $newSeat;
        }
        
        foreach($seatOcuped as $seat){
            $seatList[$seat->getNumSeat() - 1] = $seat;
        }

    return $seatList;
    }

    
    protected function create_array($num_elements){
        return array_fill(0, $num_elements,null);
    }
}


?>