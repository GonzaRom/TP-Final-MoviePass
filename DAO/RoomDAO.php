<?php

    namespace DAO;
    use Models\Rooms as Room;
    use DAO\IDAO as IDAO;

    class RoomDAO implements IDAO{
        private $roomsList=array();
        private $fileName;

        public function __Construct()
        {
            $this->fileName =dirname(__DIR__)."/Data/Rooms.json";
        }

        public function Add($room){
            $this->RetriveData();
            array_push($this->roomsList , $room);
            $this->saveData();
        }

        public function GetAll(){
            $this->RetriveData();
            return $this->roomsList;

        }
        public function Get($id){
            $this->RetriveData();
            return $this->roomsList[$id];

        }

        public function GetAllId($id){
            $this->RetriveData();
            $roomsList=array();
            foreach($this->roomsList as $room){
                if($room->Get_Cinema() == $id){
                    array_push($roomsList,$room);
                }
            }
        return $roomsList;
        }
        public function Delete($key){
            $this->RetriveData();
            unset($this->roomsList[$key]);
            $this->SaveData();
        }

        private function RetriveData(){
            $this->roomsList= array();
            if(file_exists($this->fileName)){

                $jsonContent= file_get_contents($this->fileName);

                $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();

                foreach($jsonDecode as $room){
                    $newRoom = new Room;
                    $newRoom->Set_Id($room['id']);
                    $newRoom->Set_Name($room['name']);
                    $newRoom->Set_Capacity($room['capacity']);
                    $newRoom->Set_Cinema($room['Cinema']);
                    $newRoom->Set_TypeRoom($room['typeRoom']);
                    array_push($this->roomsList , $newRoom);            
                }
            }
        }

        private function SaveData(){
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