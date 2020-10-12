<?php 
    namespace Models;

    class User{
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $usertype;

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

        public function GetFirstname()
        {
            return $this->firstname;
        }
 
        public function SetFirstname($firstname)
        {
            $this->firstname = $firstname;
            return $this;
        }

        public function GetLastname()
        {
            return $this->lastname;
        }

        public function SetLastname($lastname)
        {
            $this->lastname = $lastname;
            return $this;
        }

        public function GetEmail()
        {
            return $this->email;
        }

        public function SetEmail($email)
        {
            $this->email = $email;
            return $this;
        }
 
        public function GetPassword()
        {
            return $this->password;
        }

        public function SetPassword($password)
        {
            $this->password = $password;                
            return $this;
        }
        
        public function GetUsertype()
        {
            return $this->usertype;
        }
        
        public function SetUsertype($usertype)
        {
            $this->usertype = $usertype;
            return $this;
        }
    }
?>