<?php

namespace DAO;
 
use DAO\IUserDAO;
use Models\User;

class UserDAO implements IUserDAO{
    private $userList = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/User.json";
        
    }
    
    public function add(User $newUser)
    {
        $this->retriveData();
        array_push($this->userList, $newUser);
        $this->saveData();
        
    }
    public  function remove($id)
    {
        $this->retriveData();
        unset($this->userList[$id]);
    }

    public function get($id)
    {
        $this->retriveData();
        return $this->userList[$id];
    }

    public function getAll()
    {
        $this->retriveData();
        return $this->userList;
        
    }

    public function update($newUser)
    {
        $this->retriveData();
        $userList[$newUser->getId()] = $newUser;
        $this->saveData();
    }

    private function retriveData(){
        $this->userList = array();

        if(file_exists($this->fileName)){
           
            $jsonContent = file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();

            foreach($jsonDecode as $user){
                $newUser = new User();
                $newUser->setId($user['id']);
                $newUser->setFirstname($user['firstname']);
                $newUser->setLastname($user['lastname']);
                $newUser->setUserName($user['username']);
                $newUser->setEmail($user['email']);
                $newUser->setUsertype($user['usertype']);
                $newUser->setPassword($user['password']);

                array_push($this->userList , $newUser);
            }
        }
    }

    private function saveData(){
        $jsonEncode = array();

        foreach($this->userList as $user){
            $valuesUser = array();

            $valuesUser['id'] = $user->getId();
            $valuesUser['firstname'] = $user->getFirstName();
            $valuesUser['lastname'] = $user->getLastName();
            $valuesUser['username'] = $user->getUserName();
            $valuesUser['email'] = $user->getEmail();
            $valuesUser['usertype'] = $user->getUsertype();
            $valuesUser['password'] = $user->getPassword();

            array_push($jsonEncode , $valuesUser);
        }

        $jsonContent = json_encode($jsonEncode , JSON_PRETTY_PRINT);
        file_put_contents($this->fileName ,$jsonContent);
    }


}


?>