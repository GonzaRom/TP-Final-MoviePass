<?php

namespace DAO;

use Models\Room as Room;
use Models\RoomDTO as RoomDTO;
use DAO\IRoomDAO as IRoomDAO;

use Exception;
use Models\CinemaDTO;
use Models\TypeRoom;

class RoomDAOMSQL implements IRoomDAO
{
    private $conection;
    private $nameTable = "rooms";

    public function add(Room $room)
    {
        try {
            $sql = "INSERT INTO " . $this->nameTable . " (nameroom , capacity , idtyperoom , idcinema , ticketcost , isactive) VALUES (:nameroom , :capacity , :idtyperoom , :idcinema , :ticketcost , :isactive)";
            $parameters['nameroom'] = $this->nameRoom($room->getCinema());
            $parameters['capacity'] = $room->getCapacity();
            $parameters['idtyperoom'] = $room->getTypeRoom();
            $parameters['idcinema'] = $room->getCinema();
            $parameters['ticketcost'] = $room->getTicketCost();
            $parameters['isactive'] = $room->getIsActive();
            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try {
            $listRoom = array();
            $sql = "SELECT * FROM " . $this->nameTable;

            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql);
            foreach ($result as $room) {
                $newRoom = new RoomDTO();
                $newRoom->setId($room['idroom']);
                $newRoom->setName($room['nameroom']);
                $newRoom->setTypeRoom($this->getTypeRoom($room['idtyperoom']));
                $newRoom->setCapacity($room['capacity']);
                $newRoom->setTicketCost($room['ticketCost']);
                $newRoom->setIsActive($room['isactive']);
                array_push($listRoom, $newRoom);
            }
            return $listRoom;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function get($id)
    {
        try{
            $sql = "SELECT * FROM ". $this->nameTable ." WHERE idroom = :idroom" ;
            $parameters['idroom']= $id;

            $this->conection = Connection::getInstance();
            $resul = $this->conection->Execute($sql ,$parameters);
        }catch(Exception $ex){
            throw $ex;
        }

        if(!empty($result)){
            return $this->mapear($result);
        }
    }



    //funcion q devuelve todos las salas de un cine
    public function getByCinema($idCinema)
    {
        try{
            $listRoom = array();
            $sql = "SELECT * FROM ". $this->nameTable . " WHERE idcinema = :idcinema";
            $parameters['idcinema'] = $idCinema;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql, $parameters);
            foreach($result as $room){
                $newRoom = new RoomDTO();
                $newRoom->setId($room['idroom']);
                $newRoom->setName($room['nameroom']);
                $newRoom->setTypeRoom($this->getTypeRoom($room['idtyperoom']));
                $newRoom->setCapacity($room['capacity']);
                $newRoom->setTicketCost($room['ticketcost']);
                $newRoom->setIsActive($room['isactive']);
                array_push($listRoom, $newRoom);
            }
            return $listRoom;


        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getTypeRoom($id)
    {
        try {
            $sql = "SELECT * FROM typerooms WHERE idtyperoom = :idtyperoom";

            $parameters['idtyperoom'] = $id;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }

        if(!empty($result)){
            return $this->mapearTypeRoom($result);
        }
    }

    public function delete(RoomDTO $room)
    {
        try{
            $sql = "UPDATE ".$this->nameTable . "SET isactive = :isactive  WHERE idroom = :idroom";
            $parameters['idroom'] = $room->getId();
            $parameters['isactive'] = $room->getIsActive();

            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql , $parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }
    public function update(RoomDTO $room)
    {
        
    }
    public function deleteByCinema($id)
    {
       
        foreach ($this->roomsList as $room) {
            if ($room->getCinema() == $id) {
                $room->setActive(false);
            }
        }
      
    }

    public function nameRoom($id){
        $listRoom = $this->getByCinema($id);
        $id=0;
        $lastRoom = end($listRoom);
        if(!empty($lastRoom)){
            $id = $lastRoom->getId();
            
        }
        $id++;

        $name = "Sala ".$id; 
    return $name;
    }

    protected function mapear($value)
    {
        $value = ($value) ? $value : array();
        $resp = array_map(function ($p) {
            $newRoom = new RoomDTO();
            $newRoom->setId($p['idroom']);
            $newRoom->setName($p['nameroom']);
            $newRoom->setCapacity($p['capacity']);
            $newRoom->setTypeRoom($p['idtyperoom']);
            $newRoom->setActive($p['active']);
            return $newRoom;
        }, $value);

        return count($resp) > 1 ? $resp : $resp[0];
    }

    protected function mapearTypeRoom($value)
    {
        $value = ($value) ? $value : array();
        $resp = array_map(function ($p) {
            $newTypeRoom = new TypeRoom();
            $newTypeRoom->setId($p['idtyperoom']);
            $newTypeRoom->setName($p['nametyperoom']);

            return $newTypeRoom;
        }, $value);

        return count($resp) > 1 ? $resp : $resp[0];
    }
}