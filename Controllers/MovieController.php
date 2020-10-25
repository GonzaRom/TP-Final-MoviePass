<?php

namespace Controllers;

use DAO\GenreDAOMSQL as GenreDAOMSQL;
use DAO\MovieDAO as MovieDAO;

class MovieController
{
    private $movieDAO;
    private $GenreDAO;

    public function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->GenreDAO = new GenreDAO();
    }

    public function getall($message = "")
    {
        $nowPlayingMoviesList = array();
        $genreList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->getAll();
            $genresList = $this->GenreDAO->getAll();
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
            $message = $e->getMessage();
        }
    }

    public function get($movieId)
    {
        try {
            $movieDTO = $this->movieDAO->get($movieId);
            require_once(VIEWS_PATH . "detail-movie.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }
}
