<?php
    namespace DAO;
    use Models\Movie as Movie;

    interface IMovieDAO{
        public function add(Movie $movie);
        public function getAll();
        public function get($id);
        public function delete($key);
    }
?>
