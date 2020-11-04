<?php

namespace DAO;

use \Exception as Exception;
use Models\Genre as Genre;
use DAO\IGenreDAO as IGenreDAO;


class GenreDAOMSQL implements IGenreDAO
{
    private $genreslist = array();
    private $conectionString;
    private $KEY_PATH;
    private $connection;
    private $tableName = "genres";

    public function __construct()
    {
        $this->KEY_PATH = "75dfe3da15b955043c881c4089025e7c";
        $this->conectionString = "https://api.themoviedb.org/3/genre/movie/list?api_key=" . $this->KEY_PATH . "&language=es-ES";
    }

    public function add(Genre $newgenre)
    {
        try {
            $query = "call add_genre( :id, :name);";

            $parameters['id'] = $newgenre->getId();
            $parameters["name"] = $newgenre->getName();

            $this->connection = Connection::getInstance();

            $this->connection->executeNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update(Genre $genre)
    {
        try {
            $query = "call update_genre(:id, :name);";
            $parameters['id'] = $genre->getId();
            $parameters["name"] = $genre->getName();

            $this->connection = Connection::getInstance();

            $this->connection->executeNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try {
            $genrelist = array();

            $query = "call get_genres();";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query);

            foreach ($resultSet as $row) {
                $genre = new Genre();
                $genre->setId($row["idgenre"]);
                $genre->setName($row["namegenre"]);

                array_push($genrelist, $genre);
            }

            return $genrelist;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function updateFromApi()
    {
        try {
            $this->retriveGenresFromApi();
            foreach ($this->genreslist as $genre) {
                $this->add($genre);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function get($id)
    {
    }

    public function retriveGenresFromApi()
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
                array_push($this->genreslist, $genre);
            }
        }
    }

    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->genreslist as $genre) {
            $valuesArray["id"] = $genre->getId();
            $valuesArray["name"] = $genre->getName();
            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->filename, $jsonContent);
    }

    private function retrieveData()
    {
        $this->genreslist = array();

        if (file_exists($this->filename)) {
            $jsonContent = file_get_contents($this->filename);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                $genre = new Genre();
                $genre->setId($valuesArray["id"]);
                $genre->setName($valuesArray["name"]);
                array_push($this->genreslist, $genre);
            }
        }
    }
}
