<?php

namespace Controllers;

use DAO\MovieDAO as MovieDAO;

class HomeController
{
    private $movieDAO;

    public function __construct()
    {
        $this->movieDAO = new MovieDAO();
    }
    public function index($message = "")
    {
        $nowPlayingMoviesList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->getAllBackground();
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
