<?php

namespace Controllers;

use DAO\GenreDAO;
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
            echo $e->getMessage();
        }
    }

    public function get($movieId)
    {
        try {
            $movieDTO = $this->movieDAO->get($movieId);
            $genres = $movieDTO->getGenres();
            require_once(VIEWS_PATH . "detail-movie.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }
}
