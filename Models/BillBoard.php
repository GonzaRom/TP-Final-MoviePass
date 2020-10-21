<?php
namespace Models;

class BillBoard
{
    private $id;
    private $idCinema;

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

    public function getIdCinema()
    {
        return $this->idCinema;
    }

    public function setIdCinema($idCinema)
    {
        $this->idCinema = $idCinema;
    }
}
