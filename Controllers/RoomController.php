<?php
namespace Controllers;

use DAO\RoomDAO as RoomDAO;
use Models\Rooms as Rooms;
use DAO\CinemaDAO as CinemaDAO;

class RoomController {
    private  $roomDao; /* Contiene las funciones para control de repositorios de rooms y bdd*/
    private  $cinemaDao;
    public function __Construct()
    {
        $this->roomDao= new RoomDAO(); 
        $this->cinemaDao = new CinemaDAO();
    }

    public function ShowAddView(){
        $listcinema = $this->cinemaDao->GetAll();
        require_once(VIEWS_PATH."add-Room.php");
    }

    public function ShowLisView(){
        $listRooms = $this->AlterCinemaRooms();
        require_once(VIEWS_PATH."list-room");
        
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

}
?>