<?php

namespace DAO;

use Models\Room as Room;
use Models\RoomDTO as RoomDTO;
use DAO\IRoomDAO as IRoomDAO;

use Exception;
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
            $sql = "SELECT * FROM " . $this->nameTable . " as r INNER JOIN typerooms as t ON r.idtyperoom = t.idtyperoom WHERE r.isactive = :isactive" ;
            $parameters['active']=true;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql);
            foreach ($result as $room) {
                $newRoom = new RoomDTO();
                $newTypeRoom = new TypeRoom();
                $newTypeRoom->setId($result['idtyperoom']);
                $newTypeRoom->setId($result['nametyperoom']);
                $newRoom->setId($room['idroom']);
                $newRoom->setName($room['nameroom']);
                $newRoom->setTypeRoom($newTypeRoom);
                $newRoom->setCapacity($room['capacity']);
                $newRoom->setTicketCost($room['ticketcost']);
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
            $sql = "SELECT * FROM ". $this->nameTable ." as r INNER JOIN typerooms as t ON r.idtyperoom = t.idtyperoom WHERE idroom = :idroom" ;
            $parameters['idroom']= $id;
            $this->conection = Connection::getInstance();
            $resul = $this->conection->Execute($sql ,$parameters);
        }catch(Exception $ex){
            throw $ex;
        }

        if(!empty($resul)){
            return $this->mapear($resul);
        }
    }



    //funcion q devuelve todos las salas de un cine
    public function getByCinema($idCinema)
    {
        try{
            $listRoom = array();
            $sql = "SELECT * FROM ". $this->nameTable . " as r INNER JOIN typerooms as t ON r.idtyperoom = t.idtyperoom WHERE r.idcinema = :idcinema AND r.isactive = :isactive";
            $parameters['idcinema'] = $idCinema;
            $parameters['isactive'] = true;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql, $parameters);
            foreach($result as $room){
                $newRoom = new RoomDTO();
                $newTypeRoom = new TypeRoom();
                $newTypeRoom->setId($room['idtyperoom']);
                $newTypeRoom->setName($room['nametyperoom']);
                $newRoom->setId($room['idroom']);
                $newRoom->setName($room['nameroom']);
                $newRoom->setTypeRoom($newTypeRoom);
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

    public function delete($id)
    {
        try{

            $sql = "UPDATE ".$this->nameTable . " SET isactive = :isactive  WHERE idroom = :idroom";
            $parameters['idroom'] = $id;
            $parameters['isactive'] = false;

            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql , $parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByCinemaInactive($idCinema)
    {
        try{
            $listRoom = array();
            $sql = "SELECT * FROM ". $this->nameTable . " as r INNER JOIN typerooms as t ON r.idtyperoom = t.idtyperoom WHERE r.idcinema = :idcinema AND r.isactive = :isactive";
            $parameters['idcinema'] = $idCinema;
            $parameters['isactive'] = false;
            $this->conection = Connection::getInstance();
            $result = $this->conection->Execute($sql, $parameters);
            foreach($result as $room){
                $newRoom = new RoomDTO();
                $newTypeRoom = new TypeRoom();
                $newTypeRoom->setId($room['idtyperoom']);
                $newTypeRoom->setName($room['nametyperoom']);
                $newRoom->setId($room['idroom']);
                $newRoom->setName($room['nameroom']);
                $newRoom->setTypeRoom($newTypeRoom);
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
    public function upRoom($id)
    {
        try{

            $sql = "UPDATE ".$this->nameTable . " SET isactive = :isactive  WHERE idroom = :idroom";
            $parameters['idroom'] = $id;
            $parameters['isactive'] = true;

            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql , $parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }
    public function update(RoomDTO $room)
    {
        try{
            $sql = "UPDATE ". $this->nameTable . " SET idtyperoom = :idtyperoom , capacity = :capacity , ticketcost = :ticketcost WHERE idroom = :idroom";
            $parameters['idroom'] = $room->getId();
            $parameters['idtyperoom']= $room->getTypeRoom();
            $parameters['capacity']=$room->getCapacity();
            $parameters['ticketcost']=$room->getTicketCost();

            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql , $parameters);
        }catch(Exception $ex){
            throw $ex;
        }
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
        echo "llego";
        $id++;

        $name = "Sala ".$id; 
    return $name;
    }

    protected function mapear($value)
    {
        $value = ($value) ? $value : array();
        $resp = array_map(function ($p) {
            $newRoom = new RoomDTO();
            $newTypeRoom = new TypeRoom();
            $newTypeRoom->setId($p['idtyperoom']);
            $newTypeRoom->setName($p['nametyperoom']);
            $newRoom->setId($p['idroom']);
            $newRoom->setName($p['nameroom']);
            $newRoom->setCapacity($p['capacity']);
            $newRoom->setTypeRoom($newTypeRoom);
            $newRoom->setIsActive($p['isactive']);
            $newRoom->setTicketCost($p['ticketcost']);
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