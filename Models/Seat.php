<?php
    namespace Models;

    class Seat{
        private $id;
        private $occupied;

        public function __Construct(){
            $this->occupied=false;
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
 
        public function GetOccupied()
        {
            return $this->occupied;
        }

        public function SetOccupied($occupied)
        {
            $this->occupied = $occupied;
            return $this;
        }
    }
?>