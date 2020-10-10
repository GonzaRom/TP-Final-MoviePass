<?php

namespace DAO;
use Models\Rooms as Room;
use DAO\IDAO as IDAO;

class RoomDAO implements IDAO{
    private $roomsList=array();
    private $fileName;

    public function __construct()
    {
        $this->fileName =dirname(__DIR__)."/Data/Rooms.json";
    }

    public function Add($room){
        $this->retriveData();
        array_push($this->roomsList , $room);
        $this->saveData();
    }

    public function GetAll(){
        $this->retriveData();
        return $this->roomsList;

    }
    public function Get($id){
        $this->retriveData();
        return $this->roomsList[$id];

    }
    public function Delete($key){
        $this->retriveData();
        unset($this->roomsList[$key]);
        $this->saveData();
    }

    private function retriveData(){
        $this->roomsList= array();
        if(file_exists($this->fileName)){

            $jsonContent= file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();

            foreach($jsonDecode as $room){
                $newRoom = new Room;
                $newRoom->set_id($room['id']);
                $newRoom->set_name($room['name']);
                $newRoom->set_capacity($room['capacity']);
                $newRoom->set_Cinema($room['Cinema']);
                $newRoom->set_typeRoom($room['typeRoom']);

                array_push($this->roomsList , $newRoom);            }

        }
    }

    private function saveData(){
        $jsonEncode = array();

        foreach ($this->roomsList as $room){
            $valuesRoom=array();
            $valuesRoom['id'] = $room->get_id();
            $valuesRoom['name'] = $room->get_name();
            $valuesRoom['capacity'] = $room->get_capacity();
            $valuesRoom['typeRoom'] = $room->get_typeRoom();
            $valuesRoom['Cinema'] = $room->get_Cinema();

            array_push($jsonEncode , $valuesRoom);
        }
        
        $jsonContent = json_encode($jsonEncode , JSON_PRETTY_PRINT);

        file_put_contents($this->fileName , $jsonContent);
    }

}



?>