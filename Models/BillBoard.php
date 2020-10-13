<?php 
    namespace Models;

    class BillBoard{
        private $id;
        private $idcinema;
        private $movieshows;

        public class __Construct(){
            $this->movieshows=array();
        }

        public function GetId()
        {
            return $this->id;
        }
 
        public function SetId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function GetIdCinema()
        {
            return $this->idcinema;
        }

        public function SetIdCinema($idcinema)
        {
            $this->idcinema = $idcinema;
            return $this;
        }

        public function GetMovieShows()
        {
            return $this->movieshows;
        }

        public function SetMovieShows($movieshows)
        {
            $this->movieshows = $movieshows;
            return $this;
        }
    }
?>