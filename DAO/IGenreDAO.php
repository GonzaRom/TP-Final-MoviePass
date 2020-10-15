<?php
    namespace DAO;
    use Models\Genre as Genre;

    interface IGenreDAO{
        public function updateFromApi();
        public function getAll();
        public function get($id);
    }
?>
