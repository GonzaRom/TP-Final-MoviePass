<?php

    namespace DAO;
    use Models\Room as Room;
    use Models\RoomDTO as RoomDTO;
    use DAO\IRoomDAO as IRoomDAO;
    use DAO\TypeRoomDAO as TypeRoomDAO;
    use DAO\CinemaDAO as CinemaDAO;

class RoomDAO implements IRoomDAO{
        private $roomsList=array();
        private $fileName;
        private $typeRoomDAO;
        private $cinemaDAO;

        public function __construct()
        {
            $this->fileName =dirname(__DIR__)."/Data/Rooms.json";
            $this->typeRoomDAO = new TypeRoomDAO();
            $this->cinemaDAO = new CinemaDAO(); 
        }

        public function add(Room $room){
            $this->retriveData();
            array_push($this->roomsList , $room);
            $this->saveData();
        }

        public function getAll(){
            $this->retriveData();
            return $this->roomsList;

        }
        public function get($id){
            $this->retriveData();
            return $this->roomsList[$id];

        }

        //funcion q devuelve todos las salas de un cine
        public function getAllId($id){
            $this->retriveData();
            $roomsList=array();
            foreach($this->roomsList as $room){
                if($room->getCinema() == $id){
                    array_push($roomsList,$room);
                }
            }
        return $roomsList;
        }
        public function delete($key){
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
                    $newRoom->setId($room['id']);
                    $newRoom->setName($room['name']);
                    $newRoom->setCapacity($room['capacity']);
                    $newRoom->setCinema($room['Cinema']);
                    $newRoom->setTypeRoom($room['typeRoom']);
                    array_push($this->roomsList , $newRoom);            
                }
            }
        }

        private function saveData(){
            $jsonEncode = array();

            foreach ($this->roomsList as $room){
                $valuesRoom=array();
                $valuesRoom['id'] = $room->getId();
                $valuesRoom['name'] = $room->getName();
                $valuesRoom['capacity'] = $room->getCapacity();
                $valuesRoom['typeRoom'] = $room->getTypeRoom();
                $valuesRoom['Cinema'] = $room->getCinema();

                array_push($jsonEncode , $valuesRoom);
            }
            
            $jsonContent = json_encode($jsonEncode , JSON_PRETTY_PRINT);

            file_put_contents($this->fileName , $jsonContent);
        }

    }
