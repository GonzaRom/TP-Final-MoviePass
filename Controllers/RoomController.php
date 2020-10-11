<?php
namespace Controllers;

use DAO\RoomDAO as RoomDAO;
use Models\Rooms as Rooms;
use DAO\CinemaDAO as CinemaDAO;
use DAO\TypeRoomDAO as TypeRoomDAO;

class RoomController {
    private  $roomDao; /* Contiene las funciones para control de repositorios de rooms y bdd*/
    private  $cinemaDao;/* Contienes las funciones de control de repositorios de cinema y bdd ,  las utilizaremos adjuntar los objetos tipo cinema, en los atributos cinema de cada room*/ 
    private  $typeroomDao;

    public function __Construct()
    {
        $this->roomDao= new RoomDAO(); 
        $this->cinemaDao = new CinemaDAO();
        $this->typeroomDao= new TypeRoomDAO();
    }
    
    /* se le proporcionara una lista de cinemas , para utilizar en un select, de esta manera la carga de salas dependera de que un cine exista en la bdd o json*/
    public function ShowAddView($message=""){/* se encarga de las vistas para agregar una nueva room*/
        $listcinema = $this->cinemaDao->GetAll();
        $listtyperoom= $this->typeroomDao->GetAll();;
        require_once(VIEWS_PATH."add-Room.php");
    }
    /* se le proporcionara una lista de objetos rooms con objetos cinema ya cargado en su atributo correspondiente */
    public function ShowLisView(){/*se encargara de listar y mostrar todos las rooms */
        $listRooms = $this->AlterCinemaRooms();
        require_once(VIEWS_PATH."list-room");
        
    }

    public function addRooms($cinema, $typeroom ,$capacity ){

        $newroom= new Rooms;
        $newroom->set_name($this->nameRoom());
        $newroom->set_capacity($capacity);
        $newroom->set_typeRoom($typeroom);
        $newroom->set_Cinema($cinema);

        $this->roomDao->Add($newroom);

        $this->showAddView(1);
    }

    

    private function AlterCinemaRooms(){
        $listrooms = $this->roomDao->GetAll();
        $listcinema = $this->cinemaDao->GetAll();
        $listcinemarooms=array();
        foreach($listrooms as $room){
            $cinemaname = ($listcinema[$room->Get_Cinema()]) ? $listcinema[$room->Get_Cinema()]->GetName() : "";
            $room->Set_Cinema($cinemaname);
            array_push($listcinemarooms , $room);
        }

    return $listcinemarooms;
    }

    private function nameRoom(){
        $listRooms=$this->roomDao->GetAll();
        $lastRoom= end($listRooms);
        $id=0;
        if($lastRoom){
            $id = $lastRoom->get_name();
            $arrayExplode=explode('Sala ',$id);
            $id = $arrayExplode[1];
        }

        $id++;
        $name = "Sala ".$id;
    return $name;
    }


    private function GetRoomsCinema($id){
        $listCinema=$this->cinemaDao->GetAll();
    }

}
?>