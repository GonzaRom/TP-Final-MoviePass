<?php
namespace DAO;

use Models\TypeMovieShow;



class TypeMovieShowDAO implements ITypeMovieShowDAO{
    private $listTypeMovieShow  = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/TypeMovieShow.json";
    }

    public function getAll()
    {
        $this->retriveData();
        return $this->listTypeMovieShow;
        
    }

    private function retriveData(){
        $this->listTypeMovieShow = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();

            foreach($jsonDecode as $typeMovieShow){
                $newTMS = new TypeMovieShow();
                $newTMS->setId($typeMovieShow['id']);
                $newTMS->setName($typeMovieShow['name']);
                $newTMS->setCostTicket($typeMovieShow['costTicket']);

                array_push($this->listTypeMovieShow,$newTMS);
            }

        }
    }
}



?>