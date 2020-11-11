<?php
    namespace DAO;
    use Models\TypeRoom as TypeRoom;

    interface ITypeRoomDAO{
        public function add(TypeRoom $typeroom);
        public function getAll();
        public function get($id);
        public function getByName($nametyperoom);
    }
?>
