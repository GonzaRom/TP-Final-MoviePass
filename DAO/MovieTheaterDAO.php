<?php
    namespace DAO;

    use Models\MovieTheater as MovieTheater;
    use DAO\IMovieTheater as IMovieTheater;

    class MovieTheaterDAO implements IMovieTheaterDAO{
        private $movitheaterlist=array();
        private $filename;

        public function __Construct(){
            $this->filename=dirname(__dir__)."/Data/MovieTheaters.json";
        }

        public function Get($id){
            $this->RetrieveData();
            return $this->movitheaterlist[$id];
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->movitheaterlist;
        }

        public function Add(MovieTheater $newmovietheater){
            $this->RetrieveData();
            array_push($this->movitheaterlist,$newmovietheater);
            $this->SaveData();
        } 

        public function Delete($key){
            $this->RetrieveData();
            unset($this->movitheaterlist[$key]);
            $this->SaveData();                       
        }

        private function SaveData(){
            $arrayToEncode=array();
    
            foreach($this->movitheaterlist as $movietheater){
                $valuesArray["id"]=$movietheater->GetId();
                $valuesArray["name"]=$movietheater->GetName();
                $valuesArray["adress"]=$movietheater->GetAdress();
                $valuesArray["phonenumber"]=$movietheater->GetPhonenumber();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent=json_encode($arrayToEncode, JSON_PRETTY_PRINT);
       
            file_put_contents($this->filename,$jsonContent);
        }

        private function RetrieveData(){
            $this->movitheaterlist=array();

            if(file_exists($this->filename)){
                $jsonContent=file_get_contents($this->filename);
                $arrayToDecode= ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $movietheater=new MovieTheater();
                    $movietheater->SetId($valuesArray["id"]);
                    $movietheater->SetName($valuesArray["name"]);
                    $movietheater->SetAdress($valuesArray["adress"]);
                    $movietheater->SetPhonenumber($valuesArray["phonenumber"]);                    
                    array_push($this->movietheaterlist,$movietheater);
                }
            }
        }
    }
?>