<?php
namespace Models;
class MovieDTO{
    private $id;
    private $originalTitle;
    private $synopsis;
    private $shortSynopsis;
    private $releaseDate;
    private $title;
    private $genres;
    private $originalLanguage;
    private $voteAverage;
    private $background;
    private $poster;
    private $runtime;
    private $active;
    private $trailer;
    
    public function __construct()
    {
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getGenres()
    {
        return $this->genres;
    }

    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    public function getOriginalLanguage()
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage($originalLanguage)
    {
        $this->originalLanguage = $originalLanguage;
    }

    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = $voteAverage;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function setBackground($background)
    {
        $this->background = $background;
    }

    public function getPoster()
    {
        return $this->poster;
    }

    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    public function getShortSynopsis()
    {
        return $this->shortSynopsis;
    }

    public function setShortSynopsis($shortSynopsis)
    {
        $this->shortSynopsis = $shortSynopsis;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
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
