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
        $listRooms = $this->showAllRooms();
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
        $newroom->setActive(true);
        $this->roomDao->add($newroom);

        $this->showAddView(1);
    }

    private function showAllRooms()
    {
        $roomsList = $this->roomDao->GetAll();
        $roomsDTOList = array();
        foreach ($roomsList as $room) {
            $roomDTO = new RoomDTO();
            $roomDTO->setId($room->getId());
            $roomDTO->setName($room->getName());
            $roomDTO->setCapacity($room->getCapacity());
            $roomDTO->setActive($room->getActive());
            $typeRoom = $this->typeroomDao->get($room->getTypeRoom());
            $cinema = $this->cinemaDao->get($room->getCinema());
            $roomDTO->setCinemaName(($cinema) ? $cinema->getName() : "");
            $roomDTO->setTypeRoomName($typeRoom->getName());
            array_push($roomsDTOList, $roomDTO);
        }
        if (count($roomsDTOList) > 0) return $roomsDTOList;
        return null;
    }

    private function nameRoom($idCinema)
    {
        $listRooms = $this->roomDao->getCinema($idCinema);
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
