<?php
    namespace DAO;
    use Models\Cinema as Cinema;

    interface ICinemaDAO{
        public function Add(Cinema $cinema);
        public function GetAll();
        public function Get($id);
        public function Delete($key);
    }
?>
