<?php

namespace Controllers;

use DAO\GenreDAOMSQL as GenreDAOMSQL;
use Helpers\IsAuthorize as IsAuthorize;

class GenreController
{
    private $genreDAO;

    public function __construct()
    {
        $this->genreDAO = new GenreDAOMSQL();
    }
    
    public function update()
    { //funcion q hace un update en nuestra base de dato de generos.
        require_once(VIEWS_PATH."validated-usertype.php");
        $this->genreDAO->updateFromApi();

    }
}
