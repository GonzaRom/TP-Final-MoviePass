<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\BillBoard as BillBoard;
    use DAO\IBillBoardDAO as IBillBoardDAO;

    class BillBoardDAOMSQL implements IBillBoardDAO
    {
        private $connection;
        private $tableName = "billboards";

        public function remove($id)
        {
        }

        public function getByIdCinema($id = 0)
        {
            
        }

        public function add(BillBoard $newbillboard){
            try{
                $query= "INSERT INTO ".$this->tableName. "(idbillboard,idcinema,) VALUES (:id,:idCinema);";
            
                $parameters['id'] = $newbillBoard->getId();
                $parameters["idCinema"] = $newbillboard->getIdCinema();
               
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
                $billboard;

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->execute($query);
                
                $billboard = new Billboard();
                $billboard->setId($resultSet["idbillboard"]);
                $billboard->setIdCinema($resultSet["idcinema"]);
                return $billboard;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>