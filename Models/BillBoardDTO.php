<?php
namespace Models;

class BillBoardDTO
{
    private $id;
    private $movieshows;

    public function __construct()
    {
        $this->movieshows = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function getMovieShows()
    {
        return $this->movieshows;
    }

    public function setMovieShows($movieshows)
    {
        $this->movieshows = $movieshows;
        return $this;
    }
}
