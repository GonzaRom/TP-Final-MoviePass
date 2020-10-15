<?php
    namespace DAO;
    use Models\Cinema as Cinema;

    interface ICinemaDAO{
        public function add(Cinema $cinema);
        public function getAll();
        public function get($id);
        public function delete($key);
        public function update($key, Cinema $cinema);
    }
?>
