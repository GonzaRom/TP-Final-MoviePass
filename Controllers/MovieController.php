<?php
namespace Controllers;

use DAO\GenreDAOMSQL as GenreDAOMSQL;
use DAO\MovieDAOMSQL as MovieDAOMSQL;
use Helpers\IsAuthorize as IsAuthorize;

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
        if(IsAuthorize::isauthorize()){
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
    }

    public function detailMovie($movie){
        $movieDTO = $this->movieDAOMSQL->get($movie);
         require_once(VIEWS_PATH . "detail-movie.php");
    }
}
