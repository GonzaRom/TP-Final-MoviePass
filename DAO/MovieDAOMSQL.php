<?php

namespace DAO;

use Models\Movie as Movie;
use DAO\IMovieDAO as IMovieDAO;
use Exception;

class MovieDAOMSQL implements IMovieDAO
{
    private $KEY_PATH;
    private $NowPlayingMovieList = array();
    private $connection;
    private $tableName = "movies";

    public function __construct()
    {
        $this->KEY_PATH = "75dfe3da15b955043c881c4089025e7c";
    }

    public function getAll()
    {
        try {
            $movieList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query);

            foreach ($resultSet as $row) {
                $movie = new Movie();
                $movie->setId($row["idmovie"]);
                $movie->setImdbID($row["imdbid"]);
                $movie->setTitle($row["namemovie"]);
                $movie->setSynopsis($row["synopsis"]);
                $movie->setPoster($row["poster"]);
                $movie->setBackground($row["background"]);
                $movie->setVoteAverage($row["voteAverage"]);
                $movie->setRunTime($row["runtime"]);

                array_push($movieList, $movie);
            }
            return $movieList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function get($id)
    {
        try {
            $movieList = array();

            $query = "SELECT * FROM " . $this->tableName . "WHERE idmovie = :id ;";

            $this->connection = Connection::getInstance();

            $resultMovie = $this->connection->execute($query);

            $movie = new Movie();
            $movie->setId($resultMovie["idmovie"]);
            $movie->setImdbID($resultMovie["imdbid"]);
            $movie->setTitle($resultMovie["namemovie"]);
            $movie->setSynopsis($resultMovie["synopsis"]);
            $movie->setPoster($resultMovie["poster"]);
            $movie->setBackground($resultMovie["background"]);
            $movie->setVoteAverage($resultMovie["voteAverage"]);
            $movie->setRunTime($resultMovie["runtime"]);
            
            return $movie;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($key)
    {
        //TO DO
    }

    public function add(Movie $newMovie)
    {
        try {
            $query = " INSERT INTO " . $this->tableName . "(idmovie , imdbid , namemovie , synopsis , poster , background , voteAverage , runtime ) VALUES ( :id , :imdbid , :namemovie , :synopsis , :poster , :background , :voteAverage , :runtime );";

            $parameters['id'] = $newMovie->getId();
            $parameters['imdbid'] = $newMovie->getImdbID();
            $parameters["namemovie"] = $newMovie->getTitle();
            $parameters["synopsis"] = $newMovie->getSynopsis();
            $parameters["poster"] = $newMovie->getPoster();
            $parameters["background"] = $newMovie->getBackground();
            $parameters["voteAverage"] = $newMovie->getVoteAverage();
            $parameters["runtime"] = $newMovie->getRunTime();

            $this->connection = Connection::getInstance();

            $this->connection->executeNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update(Movie $movie)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET namemovie = :name WHERE idmovie = :id ;";
            $parameters['id'] = $movie->getId();
            $parameters["imdbid"] = $movie->getImdbID();
            $parameters["name"] = $movie->getTitle();
            $parameters["synopsis"] = $movie->getSynopsis();
            $parameters["poster"] = $movie->getPoster();
            $parameters["background"] = $movie->getBackground();
            $parameters["voteAverage"] = $movie->getVoteAverage();
            $parameters["runtime"] = $movie->getRunTime();

            $this->connection = Connection::getInstance();

            $this->connection->executeNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function updateFromApi()
    {
        try {
            $this->retriveMoviesFromApi();
            foreach ($this->NowPlayingMovieList as $movie) {
                $this->add($movie);
            }
            return $this->NowPlayingMovieList;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function retriveMoviesFromApi()
    {
        $this->NowPlayingMovieList = array();
        $endpointNowPlayingApi = "https://api.themoviedb.org/3/movie/now_playing?api_key=" . $this->KEY_PATH . "&language=es-ES";
        $apiMovieContent = file_get_contents($endpointNowPlayingApi);
        $apiMovieDecode = ($apiMovieContent) ? json_decode($apiMovieContent, true) : array();
        if (count($apiMovieDecode) <= 0) throw new Exception("Failed retriving data from api.");

        else {
            $apiMovieList = $apiMovieDecode["results"];

            for ($i = 0; $i < count($apiMovieList); $i++) {
                $apiMovieData = $apiMovieList[$i];
                $endPointMovieApi = "https://api.themoviedb.org/3/movie/" . $apiMovieData["id"] . "?api_key=" . $this->KEY_PATH . "&language=es-ES&append_to_response=videos";
                $apiMovieContent = file_get_contents($endPointMovieApi);
                $apiMovieDecode = ($apiMovieContent) ? json_decode($apiMovieContent, true) : array();
                if (count($apiMovieDecode) <= 0) throw new Exception("Failed retriving data from api.");

                else {
                    $movie = new Movie();
                    $movie->setImdbId($apiMovieDecode["id"]);
                    $movie->setOriginalTitle($apiMovieDecode["original_title"]);
                    $movie->setSynopsis($apiMovieDecode["overview"]);
                    $movie->setShortSynopsis($apiMovieDecode["tagline"]);
                    $movie->setReleaseDate($apiMovieDecode["release_date"]);
                    $movie->setTitle($apiMovieDecode["title"]);
                    $movie->setOriginalLanguage($apiMovieDecode["original_language"]);
                    $movie->setVoteAverage($apiMovieDecode["vote_average"]);
                    $movie->setGenres($apiMovieDecode["genres"]);
                    $movie->setBackground("http://image.tmdb.org/t/p/original" . $apiMovieDecode["backdrop_path"]);
                    $movie->setPoster("http://image.tmdb.org/t/p/original" . $apiMovieDecode["poster_path"]);
                    $movie->setRunTime($apiMovieDecode["runtime"]);

                    array_push($this->NowPlayingMovieList, $movie);
                }
            }
        }
    }
}
