<?php

namespace Controllers;

use DAO\GenreDAO as GenreDAO;

class GenreController
{
    private $GenreDAO;

    public function __Construct()
    {
        $this->GenreDAO = new GenreDAO();
    }

    public function Getall($message = "")
    {
        $genresList = array();
        try {
            $genresList = $this->GenreDAO->GetAll();
            require_once(VIEWS_PATH . "list-genres.php");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
