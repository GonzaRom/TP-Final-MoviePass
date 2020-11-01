<?php

    namespace DAO;

    use Exception as Exception;
    use Models\Ticket as Ticket;
    use Models\TicketDTO as TicketDTO;

    class TicketDAOMSQL{
        private $tablename="tickets";
        private $conection;

        
        public function add(Ticket $ticket){
            try{
                $sql = "INSERT INTO ". $this->tablename. " (idmovieshow, date_, time_, idpurchase, iduser)
                        VALUES (:idmovieshow, :date, :time, :idpurchase, :iduser)";
                $parameters['idmovieshow']=$ticket->getMovieShow();
                $parameters['date']=$ticket->getDate();
                $parameters['time']=$ticket->getTime();
                $parameters['idpurchase']=$ticket->getPurchase();
                $parameters['iduser']=$ticket->getUser();

                $this->conection= Connection::getInstance();
                $this->conection->ExecuteNonQuery($sql,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        ///tengo q terminar
        public function getAll(){
            $listtickets=array();
            try{
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query);
                    
                foreach ($resultSet as $row)
                {                
                    $ticket = new TicketDTO();
                    $ticket->setId($row['idticket']);
                    $ticket->setMovieShow($row['idmovieshow']);
                    $ticket->setDate($row['date_']);
                    $ticket->setTime($row['time_']);
                    $ticket->setUser($row['iduser']);
                    $ticket->setPurchase($row['idpurchase']);
                        
                    array_push($listtickets, $ticket);
                }

                return $listtickets;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>