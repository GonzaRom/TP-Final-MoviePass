<?php

    namespace DAO;
    
    use DAO\IUserDAO;
    use Models\User;
    use Models\UserType as UserType;
    use \Exception as Exception;

    class UserDAOMSQL implements IUserDAO{
        
        private $connection;
        private $tableName = "users";
        
        //FUNCION Q AGREGA UN NUEVO USUARIO A LA BDD
        public function add(User $newuser){
            try{
                $query= "INSERT INTO ".$this->tableName. " (idusertype, firstname, lastname, username, email, userpassword, isactive) VALUES ( :usertype, :firstname, :lastname, :username, :email, :password, true);";
            
                $parameters['firstname'] = $newuser->getFirstName();
                $parameters['lastname'] = $newuser->getLastName();
                $parameters['username'] = $newuser->getUserName();
                $parameters['email'] = $newuser->getEmail();
                $parameters['usertype'] = $newuser->getUserType();
                $parameters['password'] = $newuser->getPassword();
                $this->connection = Connection::getInstance();
                $this->connection->executeNonQuery($query, $parameters);
        
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //FUNCION Q HACE BORRADO LOGICO DE UN USUARIO
        public  function remove($id)
        {
            try{
                $query= "UPDATE " .$this->tableName ." set isactive= false WHERE iduser= :id";

                $parameters["id"]=$id;

                $this->connection=Connection::getInstance();

                $this->connection->executeNonQuery($query,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        //FUNCION Q DEVUELVE UN USUARIO BUSCANDOLO POR EL NOMBRE
        public function get($username)
        {
            try
            {
                $user = null;

                $query = "SELECT * FROM ".$this->tableName . " WHERE username = :username";

                $parameters["username"]=$username;

                $this->connection = Connection::getInstance();
                
                $resultSet = $this->connection->execute($query,$parameters);
                            
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setId($row['iduser']);
                    $user->setFirstname($row['firstname']);
                    $user->setLastname($row['lastname']);
                    $user->setUserName($row['username']);
                    $user->setEmail($row['email']);                
                    $user->setUsertype($this->getUserType($row['idusertype']));
                    $user->setPassword($row['userpassword']);
                        
                }

                return $user;
                }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //FUNCION Q GENERA EL TYPO DE USUARIO
        public function getUserType($id){
            try{

                $query="SELECT * FROM usertypes WHERE idusertype = :id";

                $parameters["id"]= $id;

                $this->connection= Connection::getInstance();
                
                $result=$this->connection->Execute($query,$parameters);

                foreach ($result as $row)
                {                
                    $usertype = new UserType();
                    $usertype->setId($row['idusertype']);
                    $usertype->setName($row['nameusertype']);
                }

                return $usertype;
            }
            catch(EXCEPTION $ex){
                throw $ex;
            }
        }

        //FUNCION Q DEVUELVE TODOS LOS USUARIOS
        public function getAll()
        {
            try
            {
                $userlist = array();

                $query = "SELECT * FROM ".$this->tableName. " as u join usertypes as us on u.idusertype=us.idusertype;";

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query);
                    
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $ustp=new UserType();
                    $ustp->setId($row['idusertype']);
                    $ustp->setName($row['nameusertype']);
                    $user->setId($row['iduser']);
                    $user->setFirstname($row['firstname']);
                    $user->setLastname($row['lastname']);
                    $user->setUserName($row['username']);
                    $user->setEmail($row['email']);
                    $user->setUsertype($ustp);
                    $user->setPassword($row['userpassword']);
                        
                    array_push($userlist, $user);
                }

                return $userlist;
                }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //FUNCION Q AHCE UN UPDATE SOBRE UN USUARIO
        public function update($newuser)
        {
            try{
                $query= "UPDATE " .$this->tableName ." set firstname= :firstname, lastname= :lastname, username= :username, email= :email, userpassword= :password WHERE iduser= :id";

                $parameters['id'] = $newuser->getId();
                $parameters['firstname'] = $newuser->getFirstName();
                $parameters['lastname'] = $newuser->getLastName();
                $parameters['username'] = $newuser->getUserName();
                $parameters['email'] = $newuser->getEmail();
                $parameters['usertype'] = $newuser->getUsertype()->getId();
                $parameters['password'] = $newuser->getPassword();

                $this->connection=Connection::getInstance();

                $this->connection->executeNonQuery($query,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

    }


?>