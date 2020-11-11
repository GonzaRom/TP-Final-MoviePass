<?php
    namespace DAO;

    use Models\Cinema as Cinema;
    use DAO\ICinemaDAO as ICinemaDAO;
    
    class CinemaDAO  {
        private $cinemalist=array();
        private $filename;

        public function __construct(){
            $this->filename=dirname(__DIR__)."/Data/Cinemas.json";
        }

        public function get($id){
            $this->retrieveData();
            $getCinema=null;
            foreach($this->cinemalist as $cinema){
                if($cinema->getId() == $id){
                    $getCinema = $cinema;
                }
            }
        return $getCinema;
        }

        public function getAll(){
            $this->retrieveData();
            return $this->cinemalist;
        }   
        
        public function add(Cinema $cinema){
            $this->retrieveData();
            array_push($this->cinemalist,$cinema);
            $this->saveData();
        } 

        /*public function update(Cinema $cinema){
            $this->retrieveData();
            $flag = false;
            foreach ($this->cinemalist as $value) {
                if($key == $value->getId()){
                    $value->setName($cinema->getName());
                    $value->setAdress($cinema->getAdress());
                    $value->setPhonenumber($cinema->getPhonenumber());
                    $flag=true;
                }
            }
            if ($flag) {
              $this->saveData();  
            }
            return $flag;
        }

        public function delete($key){
            $success = false;
            $this->retrieveData();
            foreach($this->cinemalist as $cinema){
                if($cinema->getId() == $key){
                    $cinema->setActive(false);
                    $success = true;
                } 
            }
            $this->saveData();
            return $success;                       
        }*/

        private function saveData(){
            $arrayToEncode=array();
    
            foreach($this->cinemalist as $cinema){
                $valuesArray["id"]=$cinema->getId();
                $valuesArray["name"]=$cinema->getName();
                $valuesArray["adress"]=$cinema->getAdress();
                $valuesArray["phonenumber"]=$cinema->getPhonenumber();
                $valuesArray['active']=$cinema->getActive();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent=json_encode($arrayToEncode, JSON_PRETTY_PRINT);
       
            file_put_contents($this->filename,$jsonContent);
        }

        private function retrieveData(){
            $this->cinemalist=array();

            if(file_exists($this->filename)){
                $jsonContent=file_get_contents($this->filename);
                $arrayToDecode= ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $cinema=new Cinema();
                    $cinema->setId($valuesArray["id"]);
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setAdress($valuesArray["adress"]);
                    $cinema->setPhonenumber($valuesArray["phonenumber"]);    
                    $cinema->setActive($valuesArray['active']);                
                    array_push($this->cinemalist,$cinema);
                }
            }
        }
    }
