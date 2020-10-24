<?php

namespace Models;


class RoomDTO
{
    private $id;
    private $name;
    private $capacity;
    private $typeRoom;
    private $active;
    private $ticketCost;

    public function __construct()
    {
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function getTypeRoom()
    {
        return $this->typeRoom;
    }

    public function setTypeRoom($typeRoom)
    {
        $this->typeRoom = $typeRoom;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setTicketCost($ticketCost){
        $this->ticketCost = $ticketCost;
    }

    public function getTicketCost(){
        return $this->ticketCost;
    }
}
