<?php

namespace Controllers;

use DAO\GenreDAO;
use DAO\MovieDAO as MovieDAO;

class HomeController
{
    private $movieDAO;
    private $genreDAO;

    public function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->genreDAO = new GenreDAO();
    }
    public function index($message = "")
    {
        $nowPlayingMoviesList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->getAllBackground();
            $genreList = $this->genreDAO->getAll();
            require_once(VIEWS_PATH . "home.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }
    public function login(){
        require_once(VIEWS_PATH . "login.php");
    }
}
