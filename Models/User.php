<?php 
    namespace Models;

    class User{
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $usertype;

        public function __construct(){

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

        public function getFirstname()
        {
            return $this->firstname;
        }
 
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
            return $this;
        }

        public function getLastname()
        {
            return $this->lastname;
        }

        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
            return $this;
        }
 
        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;                
            return $this;
        }
        
        public function getUsertype()
        {
            return $this->usertype;
        }
        
        public function setUsertype($usertype)
        {
            $this->usertype = $usertype;
            return $this;
        }
    }
?>