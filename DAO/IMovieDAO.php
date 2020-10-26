<?php
    namespace DAO;
    use Models\Movie as Movie;

    interface IMovieDAO{
        public function getAll();
        public function get($id);
    }
?>
