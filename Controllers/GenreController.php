<?php

namespace Controllers;

use DAO\GenreDAO as GenreDAO;

class GenreController
{
    private $GenreDAO;

    public function __construct()
    {
        $this->GenreDAO = new GenreDAO();
    }

    public function getAll($message = "")
    {
        $genresList = array();
        try {
            $genresList = $this->GenreDAO->getAll();
            require_once(VIEWS_PATH . "list-genres.php");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
