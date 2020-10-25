<?php

namespace DAO;

use \Exception as Exception;
use Models\UserType;

class UserTypeDAOMSQL implements IUserTypeDAO{
    
    private $connection;
    private $tableName = "usertypes";
    
    
    public function getAll()
    {
        try
        {
            $usertypelist = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query);
                
            foreach ($resultSet as $row)
            {                
                $usertype = new UserType();
                $usertype->setId($row["idusertype"]);
                $usertype->setName($row["nameusertype"]);
                    
                array_push($usertypelist, $usertype);
            }

            return $usertypelist;
            }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getById($id)
    {
        try
        {   
            $usertype = null;

            $query = "SELECT * FROM ".$this->tableName ." WHERE idusertype = :id";

            $parameters["idusertype"]=$id;

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query,$parameters);
                
            foreach ($resultSet as $row)
            {                
                $usertype = new UserType();
                $usertype->setId($row["idusertype"]);
                $usertype->setName($row["nameusertype"]);
                    
             
            }

            return $usertype;
            }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}       
?>