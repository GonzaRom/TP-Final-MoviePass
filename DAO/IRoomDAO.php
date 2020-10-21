<?php
    namespace DAO;
    
    use Models\Room as Room;

    interface IRoomDAO{
        public function add( Room $room);
        public function getAll();
        public function get($id);
        public function delete($key);
        public function getCinema($id);
    }
?>
