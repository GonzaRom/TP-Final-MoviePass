<?php
    namespace DAO;
    
    use Models\Room as Room;
use Models\RoomDTO;

interface IRoomDAO{
        public function add( Room $room);
        public function getAll();
        public function get($id);
        public function delete(RoomDTO $room);
        public function getByCinema($id);
        public function update(RoomDTO $room); 
    }
?>
