<?php
    namespace DAO;

    use Models\TypeRoom as TypeRoom;
    use DAO\ITypeRoomDAO as ITypeRoomDAO;
use Exception;

class TypeRoomDAOMSQL implements ITypeRoomDAO{
        private $conecction;
        private $nameTable = "typerooms";

        public function get($id){
            try{
                $sql = "SELECT * FROM ". $this->nameTable . "WHERE idtyperoom = :idtyperoom";
                $parameters['idtyperoom'] = $id;

                $this->conecction = Connection::getInstance();
                $result = $this->conecction->Execute($sql , $parameters);
            }catch(Exception $ex){
                throw $ex;
            }

            if(!empty($result)){
                return $this->mapear($result);
            }
        }

        public function getByName($nametyperoom){
            try{
                $sql = "SELECT * FROM ". $this->nameTable ." WHERE nametyperoom = :nametyperoom";
                $parameters['nametyperoom'] = $nametyperoom;

                $this->conecction = Connection::getInstance();
                $result = $this->conecction->Execute($sql , $parameters);
            }catch(Exception $ex){
                throw $ex;
            }

            if(!empty($result)){
                return $this->mapear($result);
            }
        }

        public function getAll(){
            try {
                $listTypeRoom = array();
                $sql = "SELECT * FROM ". $this->nameTable;
                $this->conecction = Connection::getInstance();
                $result = $this->conecction->Execute($sql);
                foreach($result as $typeRoom){
                    $newTypeRoom = new TypeRoom();
                    $newTypeRoom->setId($typeRoom['idtyperoom']);
                    $newTypeRoom->setName($typeRoom['nametyperoom']);
                    array_push($listTypeRoom , $newTypeRoom);
                }
                return $listTypeRoom;
                
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function add(TypeRoom $newtyperoom){
            try{
                $sql = "INSERT INTO ". $this->nameTable ." (nametyperoom) VALUES (:nametyperoom)";

            $parameters['nametyperoom'] = $newtyperoom->getName();

            $this->conecction = Connection::getInstance();
            $this->conecction->ExecuteNonQuery($sql , $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }
        protected function mapear($value)
        {
            $value = ($value) ? $value : array();
            $resp = array_map(function ($p) {
                $newTypeRoom = new TypeRoom();
                $newTypeRoom->setId($p['idtyperoom']);
                $newTypeRoom->setName($p['nametyperoom']);
                return $newTypeRoom;
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp[0];
        }
    }
?>