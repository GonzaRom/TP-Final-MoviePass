<?php

   /* namespace DAO;
    use Models\Room as Room;
    use Models\RoomDTO as RoomDTO;
    use DAO\IRoomDAO as IRoomDAO;
    use DAO\TypeRoomDAO as TypeRoomDAO;
    use DAO\CinemaDAO as CinemaDAO;

class RoomDAO implements IRoomDAO{
        private $roomsList=array();
        private $fileName;

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
            $getRoom = null;
            $this->retriveData();
            foreach($this->roomsList as $room){
                if($room->getId() == $id){
                    $getRoom = $room;
                }
            }
        return $getRoom;
        }
        //funcion q devuelve todos las salas de un cine
        public function getCinema($id)
        {   $listCinemaRoom = array();
            $this->retriveData();
            foreach($this->roomsList as $room){
                if($room->getCinema() == $id){
                    array_push($listCinemaRoom , $room);
                }
            }
        return $listCinemaRoom;
        }
        
        public function delete($key){
            $this->retriveData();
            unset($this->roomsList[$key]);
            $this->saveData();
        }

        public function deleteByCinema($id){
            $this->retriveData();
            foreach($this->roomsList as $room){
                if($room->getCinema() == $id){
                    $room->setActive(false);
                }
            }
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
                    $newRoom->setActive($room['active']);
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
                $valuesRoom['active'] = $room->getActive();

                array_push($jsonEncode , $valuesRoom);
            }
            
            $jsonContent = json_encode($jsonEncode , JSON_PRETTY_PRINT);

            file_put_contents($this->fileName , $jsonContent);
        }

        
    }
*/
?>