<?php

namespace Controllers;

use DAO\GenreDAO as GenreDAO;

class GenreController
{
    private $genreDAO;

    public function __construct()
    {
        $this->genreDAO = new GenreDAO();
    }

    /* funcion q llama a la vista de listado de generos */
    public function showListView($message = "")
    {
        $genreslist = $this->genreDAO->getAll();/* lista q almacena nuestros generos para luego mostrarlos */
        require_once(VIEWS_PATH . "list-genres.php");
    }

    public function update()
    { //funcion q hace un update en nuestra base de dato de generos
        $this->genreDAO->updateFromApi();
        $this->showListView();
    }

    public function getAll($message = "")
    {
        $genresList = array();
        try {
            $genresList = $this->genreDAO->getAll();
            $this->showListView();
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
    }
}
