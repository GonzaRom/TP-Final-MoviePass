<?php

namespace Controllers;

use DAO\GenreDAOMSQL as GenreDAOMSQL;
use DAO\MovieDAOMSQL as MovieDAOMSQL;

class MovieController
{
    private $movieDAOMSQL;

    public function __construct()
    {
        $this->movieDAOMSQL = new MovieDAOMSQL();
        $this->genreDAOMSQL = new GenreDAOMSQL();
    }

    public function UpdateMoviesToDB()
    {
        try {
            $this->genreDAOMSQL->updateFromApi();
            $movies = $this->movieDAOMSQL->updateFromApi();
            require_once(VIEWS_PATH . "home.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }


    public function ShowAllMovies(){
        $movieList = $this->movieDAOMSQL->getAll();
        require_once(VIEWS_PATH . "list-dbmovies.php");
    }

    public function detailMovie($movie){
        $movieDTO = $this->movieDAOMSQL->get($movie);
         require_once(VIEWS_PATH . "detail-movie.php");
    }
}
