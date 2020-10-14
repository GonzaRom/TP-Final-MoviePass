<?php

namespace DAO;

use Models\Genre as Genre;
use DAO\IDAO as IDAO;
use Exception;

class GenreDAO implements IDAO
{
    private $genresList = array();
    private $conectionString;
    private $KEY_PATH;

    public function __Construct()
    {
        $this->KEY_PATH = "75dfe3da15b955043c881c4089025e7c";
        $this->conectionString = "https://api.themoviedb.org/3/genre/movie/list?api_key=" . $this->KEY_PATH . "&language=es-ES";
    }

    public function Add($value)
    {
    }
    public function GetAll()
    {
        try {
            $this->RetriveGenresFromApi();
            return $this->genresList;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function Get($id)
    {
    }
    public function Delete($key)
    {
    }

    public function RetriveGenresFromApi()
    {
        $genresApiContent = file_get_contents($this->conectionString);
        $genresApiDecodec = ($genresApiContent) ? json_decode($genresApiContent, true) : array();
        if (count($genresApiDecodec) <= 0) throw new Exception("E R R O R : Failed decodec json!");
        else {
            $genresApiList = $genresApiDecodec["genres"];

            for ($i = 0; $i < count($genresApiList); $i++) {
                $apiMovieData = $genresApiList[$i];
                $genre = new Genre();
                $genre->setName($apiMovieData["name"]);
                $genre->setId($apiMovieData["id"]);
                array_push($this->genresList, $genre);
            }
        }
    }
}
