<?php

namespace DAO;

use Models\Movie as Movie;
use Models\MovieDTO as MovieDTO;
use DAO\IMovieDAO as IMovieDAO;
use Exception;

class MovieDAO implements IMovieDAO
{
    private $KEY_PATH;
    private $NowPlayingMovieList = array();

    public function __construct()
    {
        $this->KEY_PATH = "75dfe3da15b955043c881c4089025e7c";
    }

    public function getAll()
    {
        try {
            $this->retriveNowPlayingFromApi();
            return $this->NowPlayingMovieList;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllBackground()
    {
        return $this->retriveAllBackgroundFromApi();
    }

    public function get($id)
    {
        $endPointMovieApi = "https://api.themoviedb.org/3/movie/" . $id . "?api_key=" . $this->KEY_PATH . "&language=es-ES&append_to_response=videos";
        $apiMovieContent = file_get_contents($endPointMovieApi);
        $apiMovieDecode = ($apiMovieContent) ? json_decode($apiMovieContent, true) : array();
        if (count($apiMovieDecode) <= 0) {
            throw new Exception("Failed retriving data from api.");
        } else {
            $movieDTO = new MovieDTO();
            $movieDTO->setId($apiMovieDecode["id"]);
            $movieDTO->setOriginalTitle($apiMovieDecode["original_title"]);
            $movieDTO->setSynopsis($apiMovieDecode["overview"]);
            $movieDTO->setShortSynopsis($apiMovieDecode["tagline"]);
            $movieDTO->setReleaseDate($apiMovieDecode["release_date"]);
            $movieDTO->setTitle($apiMovieDecode["title"]);
            $movieDTO->setOriginalLanguage($apiMovieDecode["original_language"]);
            $movieDTO->setVoteAverage($apiMovieDecode["vote_average"]);
            $movieDTO->setGenres($apiMovieDecode["genres"]);
            $movieDTO->setBackground("http://image.tmdb.org/t/p/original" . $apiMovieDecode["backdrop_path"]);
            $movieDTO->setPoster("http://image.tmdb.org/t/p/original" . $apiMovieDecode["poster_path"]);

            return $movieDTO;
        }
    }
    public function delete($key)
    {
    }

    public function retriveNowPlayingFromApi()
    {
        $this->NowPlayingMovieList = array();
        $endpointNowPlayingApi = "https://api.themoviedb.org/3/movie/now_playing?api_key=" . $this->KEY_PATH . "&language=es-ES&page=1";
        $apiMovieContent = file_get_contents($endpointNowPlayingApi);
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
    public function retriveAllBackgroundFromApi()
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
