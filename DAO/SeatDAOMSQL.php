<?php

namespace DAO;

use Models\Seat;

class SeatDAOMSQLMSQL implements ISeatDAO{
    private $conecction;
    private $nameTable = "seats";

    public function add(Seat $seat)
    {
        try{
            $query= "INSERT INTO ".$this->tableName. " (occupied, idmovieshow) VALUES ( :occupied , :idmovieshow);";
        
            
            $parameters['occupied'] = true;
            $parameters['idmovieshow'] = $newseat->getMovieShow();
            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($query, $parameters);
    
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
                $userlist = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query);
                    
                foreach ($resultSet as $row)
                {                
                    $seat = new Seat();
                    $seat->setId($row['idseat']);
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
            $this->conection = Connection::getInstance();
            $resul = $this->conection->Execute($sql ,$parameters);
            foreach($resultSet as $row){
                $seat= new Seat();
                $seat->setId($row['idseat']);
                $seat->setOccupied($row['occupied']);
                $seat->setMovieShow($row['idmovieshow']);
            }
            return $seat;
        }catch(Exception $ex){
            throw $ex;
        }
    }
}


?>