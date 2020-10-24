<?php
    namespace DAO;
    use Models\Cinema as Cinema;
    use Models\CinemaDTO as CinemaDTO;
    interface ICinemaDAO{
        public function add(Cinema $cinema);
        public function getAll();
        public function get($id);
        public function delete(CinemaDTO $cinema);
        public function update(CinemaDTO $cinema);
    }
?>
