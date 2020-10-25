<?php

namespace Controllers;

use DAO\GenreDAOMSQL as GenreDAOMSQL;

class GenreController
{
    private $genreDAO;

    public function __construct()
    {
        $this->genreDAO = new GenreDAOMSQL();
    }
    
    public function update()
    { //funcion q hace un update en nuestra base de dato de generos.
        $this->genreDAO->updateFromApi();

    }
}
