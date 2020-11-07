<?php

    namespace DAO;

    use Exception as Exception;
    use Models\Ticket as Ticket;
    use Models\TicketDTO as TicketDTO;

    class TicketDAOMSQL{
        private $tablename="tickets";
        private $conection;

        
        public function add(Ticket $ticket){
            $id=null;
            try{
                
                $sql = "call add_ticket(:idmovieshow , :idpurchase , :iduser , :cost , :seat)";
                $parameters['idmovieshow']=$ticket->getMovieShow()->getId();
                $parameters['idpurchase']=$ticket->getPurchase();
                $parameters['iduser']=$ticket->getUser();
                $parameters['cost'] = $ticket->getTicketCost();
                $parameters['seat'] = $ticket->getSeat()->getId();
                $this->conection= Connection::getInstance();
                $this->conection->ExecuteNonQuery($sql,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function get_id($idmovieshow, $idseat){
            $id=null;
            echo $idmovieshow."//".$idseat;
            try{
                $query = "call get_id_ticket(:idmovieshow, :idseat);";
                $parameters['idmovieshow']=$idmovieshow;
                $parameters['idseat'] = $idseat;

                $this->connection = Connection::getInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                    
                foreach ($resultSet as $row)
                {                
                    $id=$row['idticket'];
                }

                return $id;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function setQr($id,$filename,$code){
            try{
                
                $sql = "call update_qr_accescode(:idticket, :qrcode, :code)";
                $parameters['idticket']=$id;
                $parameters['qrcode'] = $filename;
                $parameters['code'] = $code;

                $this->conection= Connection::getInstance();
                $this->conection->ExecuteNonQuery($sql,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function deliverTicket($code){
            try{
                $flag=false;
                $query = "call deliver_ticket(:code)";
                $parameters['code'] = $code;
                var_dump($parameters);
                $this->conection= Connection::getInstance();
                $resultSet = $this->conection->Execute($query, $parameters);
                foreach ($resultSet as $row)
                {                
                    $flag=$row['flag'];
                }
                return $flag;
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

                $resultSet = $this->conection->Execute($query);
                    
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
         
        public function getByPurchase($id){
            $tickets = array();
            try{
                $sql ='SELECT * FROM '. $this->tablename  .' as p INNER JOIN movieshows as m ON p.idmovieshow = m.idmovieshow INNER JOIN typemovieshows as tm 
                ON m.idtypemovieshow = tm.idtypemovieshow
                INNER JOIN movies as mo
                ON m.idmovie = mo.idmovie 
                INNER JOIN rooms as r 
                ON m.idroom = r.idroom 
                INNER JOIN typerooms as t 
                ON r.idtyperoom = t.idtyperoom INNER JOIN seats as s ON p.idseat = s.idseat  WHERE idpurchase = :id';
                $parameters['id'] = $id;
                $this->conection = Connection::getInstance();
                $resultSet = $this->conection->Execute($sql,$parameters);

                foreach ($resultSet as $row)
                {                
                    $ticket = new TicketDTO();
                    $ticket->setId($row['idticket']);
                    $ticket->setMovieShow(mapperDAO :: creatMovieShow($row));
                    $ticket->setUser($row['iduser']);
                    $ticket->setPurchase($row['idpurchase']);
                    $ticket->setSeats(mapperDAO :: mapearSeat($row));
                        
                    array_push($tickets, $ticket);
                }

                return $tickets;

            }catch (Exception $ex){
                throw $ex;
            }
        }
    }
?>