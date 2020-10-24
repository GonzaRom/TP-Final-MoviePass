<?php

namespace DAO;
 
use DAO\IUserDAO;
use Models\User;
use \Exception as Exception;

class UserDAOMSQL implements IUserDAO{
    
    private $connection;
    private $tableName = "users";
    
    
    public function add(User $newuser){
        try{
            $query= "INSERT INTO ".$this->tableName. "(idusertype, firstname, lastname, email, userpassword) VALUES (:usertype,:firstname, :lastname, :username, :email, :password);";
        
            $parameters['id'] = $newuser->getId();
            $parameters['firstname'] = $newuser->getFirstName();
            $parameters['lastname'] = $newuser->getLastName();
            $parameters['username'] = $newuser->getUserName();
            $parameters['email'] = $newuser->getEmail();
            $parameters['usertype'] = $newuser->getUsertype();
            $parameters['password'] = $newuser->getPassword();
           
            $this->connection = Connection::getInstance();

            $this->connection->executeNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
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
        try
        {
            $userlist = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query);
                
            foreach ($resultSet as $row)
            {                
                $user = new User();
                $user->setId($row['id']);
                $user->setFirstname($row['firstname']);
                $user->setLastname($row['lastname']);
                $user->setUserName($row['username']);
                $user->setEmail($row['email']);
                $user->setUsertype($row['usertype']);
                $user->setPassword($row['password']);
                    
                array_push($userlist, $user);
            }

            return $userlist;
            }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function update($newUser)
    {
        $this->retriveData();
        $userList[$newUser->getId()] = $newUser;
        $this->saveData();
    }

}


?>