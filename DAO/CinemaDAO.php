<?php
    namespace DAO;

    use Models\Cinema as Cinema;
    use DAO\IDAO as IDAO;
    
    class CinemaDAO implements IDAO{
        private $cinemalist=array();
        private $filename;

        public function __Construct(){
            $this->filename=dirname(__DIR__)."/Data/Cinemas.json";
        }

        public function Get($id){
            $this->RetrieveData();
            return $this->cinemalist[$id];
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->cinemalist;
        }   



        public function Add($newcinema){
            $this->RetrieveData();
            array_push($this->cinemalist,$newcinema);
            $this->SaveData();
        } 

        public function Delete($key){
            $this->RetrieveData();
            unset($this->cinemalist[$key]);
            $this->SaveData();                       
        }

        private function SaveData(){
            $arrayToEncode=array();
    
            foreach($this->cinemalist as $cinema){
                $valuesArray["id"]=$cinema->GetId();
                $valuesArray["name"]=$cinema->GetName();
                $valuesArray["adress"]=$cinema->GetAdress();
                $valuesArray["phonenumber"]=$cinema->GetPhonenumber();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent=json_encode($arrayToEncode, JSON_PRETTY_PRINT);
       
            file_put_contents($this->filename,$jsonContent);
        }

        private function RetrieveData(){
            $this->cinemalist=array();

            if(file_exists($this->filename)){
                $jsonContent=file_get_contents($this->filename);
                $arrayToDecode= ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $cinema=new Cinema();
                    $cinema->SetId($valuesArray["id"]);
                    $cinema->SetName($valuesArray["name"]);
                    $cinema->SetAdress($valuesArray["adress"]);
                    $cinema->SetPhonenumber($valuesArray["phonenumber"]);                    
                    array_push($this->cinemalist,$cinema);
                }
            }
        }
    }
?>