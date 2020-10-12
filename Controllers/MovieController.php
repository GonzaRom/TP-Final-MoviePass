<?php

namespace Controllers;

use Models\Movie as Movie;
use DAO\MovieDAO as MovieDAO;

class MovieController
{
    private $movieDAO;

    public function __Construct()
    {
        $this->movieDAO = new MovieDAO();
    }

    public function Getall($message = "")
    {
        $nowPlayingMoviesList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH . "list-movies.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }
}
