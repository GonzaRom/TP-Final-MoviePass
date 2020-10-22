<?php 
    namespace Models;

    class BillBoard{
        private $id;
        private $idcinema;
        
        public function __construct(){
            
        }

        public function getId()
        {
            return $this->id;
        }
 
        public function setId($id)
        {
            $this->id = $id;
        }

        public function getIdCinema()
        {
            return $this->idcinema;
        }

        public function setIdCinema($idcinema)
        {
            $this->idcinema = $idcinema;
        }
    }
?>