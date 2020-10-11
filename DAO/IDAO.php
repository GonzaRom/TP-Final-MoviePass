<?php
    namespace DAO;

    interface IDAO{
        public function Add($value);
        public function GetAll();
        public function Get($id);
        public function Delete($key);
    }
?>
