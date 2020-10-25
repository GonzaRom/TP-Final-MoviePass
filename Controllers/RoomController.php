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
    public function showListView($message = "")
    {/*se encargara de listar y mostrar todos las rooms */
        $listCinemas = $this->showAllRooms();
        require_once(VIEWS_PATH . "list-rooms.php");
    }

    public function showListViewInactive($message = "")
    {/*se encargara de listar y mostrar todos las rooms */
        $listCinemas = $this->showAllInactive();
        require_once(VIEWS_PATH . "list-roomsInactive.php");
    }

    public function addRooms($cinema = 0, $typeroom = 0, $capacity = 0, $ticketCost = 0)
    {
        if ($cinema == 0 || $typeroom == 0 || $capacity == 0 || $ticketCost == 0) {
            $this->showAddView();
        } else {
            $newRoom = new Room();
            $newRoom->setCinema($cinema);
            $newRoom->setTypeRoom($typeroom);
            $newRoom->setCapacity($capacity);
            $newRoom->setTicketCost($ticketCost);
            $newRoom->setIsActive(true);
            $this->roomDao->add($newRoom);

            $this->showAddView(1);
        }
    }

    private function showAllRooms()
    {
        $cinemaList = $this->cinemaDao->getAll();
        foreach ($cinemaList as $cinema) {
            $cinema->setRooms($this->roomDao->getByCinema($cinema->getId()));
        }
        return $cinemaList;
    }

    private function showAllInactive()
    {
        $cinemaList = $this->cinemaDao->getAll();
        foreach ($cinemaList as $cinema) {
            $cinema->setRooms($this->roomDao->getByCinemaInactive($cinema->getId()));
        }
        return $cinemaList;
    }

    public function delete($id)
    {
        $this->roomDao->delete($id);
        $this->showListView(2);
    }

    public function upRoom($id)
    {
        $this->roomDao->upRoom($id);
        $this->showListView(3);
    }

    public function showUpdateView($id)
    {
        $room = $this->roomDao->get($id);
        $listTypeRoom = $this->typeroomDao->getAll();
        require_once(VIEWS_PATH . 'update-room.php');
    }

    public function updateRoom($id, $typeroom, $capacity, $ticketCost)
    {
        $newRoom = new RoomDTO();
        $newRoom->setId($id);
        $newRoom->setTypeRoom($typeroom);
        $newRoom->setCapacity($capacity);
        $newRoom->setTicketCost($ticketCost);

        $this->roomDao->update($newRoom);

        $this->showListView(1);
    }
}
