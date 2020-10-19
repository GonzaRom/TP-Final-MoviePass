<?php

namespace Controllers;

use DAO\RoomDAO as RoomDAO;
use Models\Room as Room;
use Models\RoomDTO as RoomDTO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\TypeRoomDAO as TypeRoomDAO;

class RoomController
{
    private  $roomDao; /* Contiene las funciones para control de repositorios de rooms y bdd*/
    private  $cinemaDao;/* Contienes las funciones de control de repositorios de cinema y bdd ,  las utilizaremos adjuntar los objetos tipo cinema, en los atributos cinema de cada room*/
    private  $typeroomDao;

    public function __construct()
    {
        $this->roomDao = new RoomDAO();
        $this->cinemaDao = new CinemaDAO();
        $this->typeroomDao = new TypeRoomDAO();
    }

    /* se le proporcionara una lista de cinemas , para utilizar en un select, de esta manera la carga de salas dependera de que un cine exista en la bdd o json*/
    public function showAddView($message = "")
    {/* se encarga de las vistas para agregar una nueva room*/
        $listcinema = $this->cinemaDao->getAll();
        $listtyperoom = $this->typeroomDao->getAll();;
        require_once(VIEWS_PATH . "add-Room.php");
    }
    /* se le proporcionara una lista de objetos rooms con objetos cinema ya cargado en su atributo correspondiente */
    public function showListView(){/*se encargara de listar y mostrar todos las rooms */
        $listRooms = $this->alterCinemaRooms();
        require_once(VIEWS_PATH . "list-rooms.php");
    }

    public function addRooms($cinema, $typeroom, $capacity)
    {
        $newroom = new Room;
        $newroom->setId($this->idRoom());
        $newroom->setName($this->nameRoom($cinema));
        $newroom->setCapacity($capacity);
        $newroom->setTypeRoom($typeroom);
        $newroom->setCinema($cinema);

        $this->roomDao->add($newroom);

        $this->showAddView(1);
    }

    private function alterCinemaRooms()
    {
        $listrooms = $this->roomDao->GetAll();
        $listcinemarooms = array();
        foreach ($listrooms as $room) {
            $cinema = $this->cinemaDao->get($room->getCinema());
            $typeRoom =  $this->typeroomDao->get(($room->getTypeRoom()));
            $room->setCinema(($cinema) ? $cinema->getName() : "");
            $room->setTypeRoom(($typeRoom) ? $typeRoom->getName() : "");
            array_push($listcinemarooms, $room);
        }

        return $listcinemarooms;
    }

    private function nameRoom($idCinema)
    {
        $listRooms = $this->roomDao->getAllId($idCinema);
        $lastRoom = end($listRooms);
        $id = 0;
        if ($lastRoom) {
            $id = $lastRoom->getName();
            $arrayExplode = explode('Sala ', $id);
            $id = $arrayExplode[1];
        }
        $id++;
        $name = "Sala " . $id;
        return $name;
    }

    private function idRoom()
    {
        $listRooms = $this->roomDao->getAll();
        $lastRoom = end($listRooms);
        $id = 0;
        if ($lastRoom) {
            $id = $lastRoom->getId();
        }
        $id++;
        return $id;
    }
}
