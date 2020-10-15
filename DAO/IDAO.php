<?php
    namespace DAO;

    interface IDAO{
        public function add($value);
        public function getAll();
        public function get($id);
        public function delete($key);
    }
?>
