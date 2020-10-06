<?php
    namespace DAO;
    use Models\MovieTheater as MovieTheater;

    interface IMovieTheaterDAO{
        public function Add(MovieTheater $movietheater);
        public function GetAll();
        public function Get($id);
        public function Delete($key);
    }
?>
