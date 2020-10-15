<?php 
    namespace Models;

    class BillBoard{
        private $id;
        private $idcinema;
        private $movieshows;

        public function __construct(){
            $this->movieshows=array();
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

        public function getIdCinema()
        {
            return $this->idcinema;
        }

        public function setIdCinema($idcinema)
        {
            $this->idcinema = $idcinema;
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
?>