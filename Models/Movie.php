<?php

namespace Models;

class Movie
{
    private $id;
    private $imdbID;
    private $name;
    private $genreId;
    private $genreName;
    private $synopsis;
    private $poster;
    private $background;
    private $voteAverage;
    private $runtime;
    private $active;
    private $trailer;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getGenreId()
    {
        return $this->genreId;
    }

    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    public function getPoster()
    {
        return $this->poster;
    }

    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function setBackground($background)
    {
        $this->background = $background;
    }

    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = $voteAverage;
    }

    public function getImdbID()
    {
        return $this->imdbID;
    }

    public function setImdbID($imdbID)
    {
        $this->imdbID = $imdbID;
    }

    public function getGenreName()
    {
        return $this->genreName;
    }

    public function setGenreName($genreName)
    {
        $this->genreName = $genreName;
    }

    public function setRunTime($runtime){
        $this->runtime = $runtime;
    }
    public function getRunTime(){
        return $this->runtime ;
    }
    public function setIsActive($active){
        $this->active = $active;
    }

    public function getIsActive(){
        return $this->active;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }
}