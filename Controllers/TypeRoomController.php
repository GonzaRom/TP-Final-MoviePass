<?php

namespace Controllers;

use DAO\TypeRoomDAOMSQL;
use Models\TypeRoom;

class TypeRoomController{
    private $typeRoomDAO;

    public function __construct()
    {
        $this->typeRoomDAO = new TypeRoomDAOMSQL();
    }

    public function showAddTypeRoomView(){
        require_once(VIEWS_PATH."add-typeroom.php");
    }
    
    public function add($nameTypeRoom){
        $exist = $this->typeRoomDAO->getByName($nameTypeRoom);

        if(empty($exist)){

            $newTypeRoom = new TypeRoom();
            $newTypeRoom->setName($nameTypeRoom);

            $this->typeRoomDAO->add($newTypeRoom);
        }
        $this->showAddTypeRoomView();
    }


}
