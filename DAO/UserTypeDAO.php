<?php

namespace DAO;

use Models\UserType;

class UserTypeDAO implements IUserTypeDAO{
    private $userTypeList = array();
    private $fileName;
    
    public function __construct()
    {
        $this->fileName= dirname(__DIR__)."/Data/UserType.json";
    }

    public function getAll(){
        $this->retriveData();
        return $this->userTypeList;
    }

    private function retriveData(){
        $this->userTypeList = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();
            foreach($jsonDecode as $userType){
                $newUserType = new UserType();
                $newUserType->setId($userType['id']);
                $newUserType->setName($userType['name']);

                array_push($this->userTypeList, $newUserType);
            }
        }
    }
}





?>