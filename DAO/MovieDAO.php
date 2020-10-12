<?php

namespace DAO;

use Models\Movie as Movie;
use DAO\IDAO as IDAO;
use Exception;

class MovieDAO implements IDAO
{
    private $KEY_PATH;
    private $NowPlayingMovieList = array();

    public function __Construct()
    {
        $this->KEY_PATH = "75dfe3da15b955043c881c4089025e7c";
    }

    public function Add($value)
    {
    }
    public function GetAll()
    {
        try {
            $this->RetriveNowPlayingFromApi();
            return $this->NowPlayingMovieList;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function GetAllBackground()
    {
        return $this->RetriveAllBackgroundFromApi();
    }

    public function Get($id)
    {
    }
    public function Delete($key)
    {
    }

    public function RetriveNowPlayingFromApi()
    {
        $this->NowPlayingMovieList = array();
        $nowPlayingPath = "https://api.themoviedb.org/3/movie/now_playing?api_key=" . $this->KEY_PATH . "&language=es-ES&page=1";
        $apiMovieContent = file_get_contents($nowPlayingPath);
        $apiMovieDecode = ($apiMovieContent) ? json_decode($apiMovieContent, true) : array();
        if (count($apiMovieDecode) <= 0) {
            throw new Exception("Failed retriving data from api.");
        } else {
            $apiMovieList = $apiMovieDecode["results"];

            for ($i = 0; $i < count($apiMovieList); $i++) {
                $apiMovieData = $apiMovieList[$i];
                $movie = new Movie();
                $movie->setName($apiMovieData["title"]);
                $movie->setGenreId($apiMovieData["genre_ids"][0]);
                $movie->setSynopsis($apiMovieData["overview"]);
                $movie->setPoster("http://image.tmdb.org/t/p/original" . $apiMovieData["poster_path"]);
                $movie->setBackground("http://image.tmdb.org/t/p/original" . $apiMovieData["backdrop_path"]);
                $movie->setVoteAverage($apiMovieData["vote_average"]);
                $movie->setImdbID($apiMovieData["id"]);
                array_push($this->NowPlayingMovieList, $movie);
            }
        }
    }
    public function RetriveAllBackgroundFromApi()
    {
        $backgroundFromApi = array();
        $nowPlayingPath = "https://api.themoviedb.org/3/movie/now_playing?api_key=" . $this->KEY_PATH . "&language=es-ES&page=1";
        $apiMovieContent = file_get_contents($nowPlayingPath);
        $apiMovieDecode = ($apiMovieContent) ? json_decode($apiMovieContent, true) : array();
        if (count($apiMovieDecode) <= 0) {
            throw new Exception("Failed retriving data from api.");
        } else {
            $apiMovieList = $apiMovieDecode["results"];

            for ($i = 0; $i < count($apiMovieList); $i++) {
                $apiMovieData = $apiMovieList[$i];
                $movie = new Movie();
                $movie->setName($apiMovieData["title"]);
                $movie->setPoster("http://image.tmdb.org/t/p/original" . $apiMovieData["poster_path"]);
                $movie->setBackground("http://image.tmdb.org/t/p/original" . $apiMovieData["backdrop_path"]);
                $movie->setImdbID($apiMovieData["id"]);
                array_push($backgroundFromApi, $movie);
            }
            return $backgroundFromApi;
        }
    }
}