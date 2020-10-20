<?php
    namespace Models;


class RoomDTO{
    private $id;
    private $name;
    private $capacity;
    private $typeRoomName;
    private $cinemaName;

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

    public function getTypeRoomName()
    {
        return $this->typeRoomName;
    }

    public function setTypeRoomName($typeRoomName)
    {
        $this->typeRoomName = $typeRoomName;
    }

    public function getCinemaName()
    {
        return $this->cinemaName;
    }

    public function setCinemaName($cinemaName)
    {
        $this->cinemaName = $cinemaName;
    }
    }

    