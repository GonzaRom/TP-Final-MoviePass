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
    
    public function update()
    { //funcion q hace un update en nuestra base de dato de generos.
        $this->genreDAO->updateFromApi();

    }
}
