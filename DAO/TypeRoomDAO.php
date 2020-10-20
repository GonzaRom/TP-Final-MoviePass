<?php
    namespace DAO;

    use Models\TypeRoom as TypeRoom;
    use DAO\ITypeRoomDAO as ITypeRoomDAO;
    
    class TypeRoomDAO implements ITypeRoomDAO{
        private $typeroomlist=array();
        private $filename;

        public function __construct(){
            $this->filename=dirname(__DIR__)."/Data/Typerooms.json";
        }

        public function get($id){
            $this->retrieveData();
            return $this->typeroomlist[$id];
        }

        public function getAll(){
            $this->retrieveData();
            return $this->typeroomlist;
        }

        public function add(TypeRoom $newtyperoom){
            $this->retrieveData();
            array_push($this->typeroomlist,$newtyperoom);
            $this->saveData();
        } 

        public function delete($key){
            $this->retrieveData();
            unset($this->typeroomlist[$key]);
            $this->saveData();                       
        }
        
        private function saveData(){
            $arrayToEncode=array();
    
            foreach($this->typeroomlist as $typeroom){
                $valuesArray["id"]=$typeroom->getId();
                $valuesArray["name"]=$typeroom->getName();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent=json_encode($arrayToEncode, JSON_PRETTY_PRINT);
       
            file_put_contents($this->filename,$jsonContent);
        }

        private function retrieveData(){
            $this->typeroomlist=array();

            if(file_exists($this->filename)){
                $jsonContent=file_get_contents($this->filename);
                $arrayToDecode= ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $newtyperoom=new TypeRoom();
                    $newtyperoom->setId($valuesArray["id"]);
                    $newtyperoom->setName($valuesArray["name"]);                    
                    array_push($this->typeroomlist,$newtyperoom);
                }
            }
        }
    }
?>