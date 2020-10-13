<?php

namespace Controllers;

use DAO\GenreDAO;
use DAO\MovieDAO as MovieDAO;

class MovieController
{
    private $movieDAO;
    private $GenreDAO;

    public function __Construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->GenreDAO = new GenreDAO();
    }

    public function Getall($message = "")
    {
        $nowPlayingMoviesList = array();
        $genreList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->GetAll();
            $genresList = $this->GenreDAO->GetAll();
            foreach ($nowPlayingMoviesList as $movie) {
                $movieGenders = $movie->getGenreId();
                foreach ($genresList as $genreApi) {
                    if ($movieGenders === $genreApi->getId()) {
                        $movie->setGenreName($genreApi->getName());
                    }
                }
            }

            require_once(VIEWS_PATH . "list-movies.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }

    public function Get($movieId)
    {
        try {
            $movieDTO = $this->movieDAO->Get($movieId);
            require_once(VIEWS_PATH . "detail-movie.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }
}
