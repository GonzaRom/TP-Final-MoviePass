<?php
    namespace DAO;

    use Models\TypeRoom as TypeRoom;
    use DAO\IDAO as IDAO;
    
    class TypeRoomDAO implements IDAO{
        private $typeroomlist=array();
        private $filename;

        public function __Construct(){
            $this->filename=dirname(__DIR__)."/Data/Typerooms.json";
        }

        public function Get($id){
            $this->RetrieveData();
            return $this->typeroomlist[$id];
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->typeroomlist;
        }

        public function Add($newtyperoom){
            $this->RetrieveData();
            array_push($this->typeroomlist,$newtyperoom);
            $this->SaveData();
        } 

        public function Delete($key){
            $this->RetrieveData();
            unset($this->typeroomlist[$key]);
            $this->SaveData();                       
        }
        
        private function SaveData(){
            $arrayToEncode=array();
    
            foreach($this->typeroomlist as $typeroom){
                $valuesArray["id"]=$typeroom->GetId();
                $valuesArray["name"]=$typeroom->GetName();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent=json_encode($arrayToEncode, JSON_PRETTY_PRINT);
       
            file_put_contents($this->filename,$jsonContent);
        }

        private function RetrieveData(){
            $this->typeroomlist=array();

            if(file_exists($this->filename)){
                $jsonContent=file_get_contents($this->filename);
                $arrayToDecode= ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $newtyperoom=new TypeRoom();
                    $newtyperoom->SetId($valuesArray["id"]);
                    $newtyperoom->SetName($valuesArray["name"]);                    
                    array_push($this->typeroomlist,$newtyperoom);
                }
            }
        }
    }
?>