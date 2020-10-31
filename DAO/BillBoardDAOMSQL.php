<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\BillBoard as BillBoard;
    use DAO\IBillBoardDAO as IBillBoardDAO;
use Models\BillBoardDTO;

class BillBoardDAOMSQL implements IBillBoardDAO
    {
        private $connection;
        private $tableName = "billboards";

        public function remove($id)
        {
        }

        public function getByIdCinema($id)
        {
            if ($id == null || empty($id)) {
                return null;
            }
            try
            {
                $billboards = new BillBoard();

                $query = "SELECT * FROM ".$this->tableName . "WHERE idcinema = :id ;";

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->execute($query);
                foreach($resultSet as $row){
                    $billboard = new Billboard();
                    $billboard->setId($row["idbillboard"]);
                    $billboard->setIdCinema($row["idcinema"]);
                }    
                return $billboards;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function add(BillBoard $newbillBoard){
            try{
                $query= "INSERT INTO ".$this->tableName. " (idcinema , isactive) VALUES (:idCinema , :isActive);";

                $parameters["idCinema"] = $newbillBoard->getIdCinema();
                $parameters["isActive"] = true;
               
                $this->connection = Connection::getInstance();

                $this->connection->executeNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            try
            {
                $billboardlist = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $billboard = new Billboard();
                    $billboard->setId($row["idbillboard"]);
                    $billboard->setIdCinema($row["idcinema"]);
                    
                    array_push($billboardlist, $billboard);
                }

                return $billboardlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function get($id)
        {
            if ($id == null || empty($id)) {
                return null;
            }
            try
            {
                $billboard = new Billboard();

                $query = "SELECT * FROM ".$this->tableName . " WHERE idbillboard = :id ;";
                $parameters["id"] = $id;
                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->execute($query,$parameters);
                foreach($resultSet as $row){
                    $billboard->setId($row["idbillboard"]);
                    $billboard->setIdCinema($row["idcinema"]);
                }    
                return $billboard;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        
    }
?>