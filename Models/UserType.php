<?php
    namespace Models;

    class UserType{
        private $id;
        private $name;

        public function __Construct(){

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

        public function GetName()
        {
            return $this->name;
        }

        public function SetName($name)
        {
            $this->name = $name;
            return $this;
        }
    }
?>