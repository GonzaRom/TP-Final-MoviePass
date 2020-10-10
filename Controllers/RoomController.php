<?php
namespace Controllers;

use DAO\RoomDAO as RoomDAO;
use Models\Rooms as Rooms;
use DAO\CinemaDAO as CinemaDAO;

class RoomController {
    private  $roomDao; /* Contiene las funciones para control de repositorios de rooms y bdd*/
    private  $cinemaDao;
    public function __construct()
    {
        $this->roomDao= new RoomDAO(); 
        $this->cinemaDao = new CinemaDAO();
    }

    public function showAddView(){
        $listCinema = $this->cinemaDao->GetAll();
        require_once(VIEWS_PATH."add-room");
    }

    public function showLisView(){
        $listRooms = $this->alterCinemaRooms();
        require_once(VIEWS_PATH."list-room");
        
    }

    

    private function alterCinemaRooms(){
        $listRooms = $this->roomDao->GetAll();
        $listCinema = $this->cinemaDao->GetAll();
        $listCinemaRooms=array();
        foreach($listRooms as $room){
            $cinemaName = ($listCinema[$room->get_Cinema()]) ? $listCinema[$room->get_Cinema()]->GetName() : "";
            $room->set_Cinema($cinemaName);
            array_push($listCinemaRooms , $room);
        }

    return $listCinemaRooms;
    }

}
?>