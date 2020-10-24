<?php

namespace Controllers;

use DAO\RoomDAOMSQL as RoomDAO;
use Models\Room as Room;
use Models\RoomDTO as RoomDTO;
use DAO\CinemaDAOMSQL as CinemaDAO;
use DAO\TypeRoomDAOMSQL as TypeRoomDAO;

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
        print_r($listcinema);
        $listTypeRoom = $this->typeroomDao->getAll();
        require_once(VIEWS_PATH . "add-Room.php");
    }
    /* se le proporcionara una lista de objetos rooms con objetos cinema ya cargado en su atributo correspondiente */
    public function showListView(){/*se encargara de listar y mostrar todos las rooms */
        $listCinemas = $this->showAllRooms();
        require_once(VIEWS_PATH . "list-rooms.php");
    }

    public function addRooms($cinema, $typeroom, $capacity , $ticketCost)
    {
        $newRoom = new Room();
        $newRoom->setCinema($cinema);
        $newRoom->setTypeRoom($typeroom);
        $newRoom->setCapacity($capacity);
        $newRoom->setTicketCost($ticketCost);
        $newRoom->setActive(true);
        $this->roomDao->add($newRoom);

        $this->showAddView(1);
    }

    private function showAllRooms()
    {
        $cinemaList = $this->cinemaDao->getAll();
        foreach($cinemaList as $cinema){
            $cinema->setRooms($this->roomDao->getByCinema($cinema->getId()));
        }
        return $cinemaList;
    }

    private function nameRoom($idCinema)
    {
        $listRooms = $this->roomDao->get($idCinema);
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
